@extends('layouts.main')

@section('title', 'Agenda del Gobernador - Gobernación del Beni')

@section('content')
<div class="container mx-auto px-4 py-8" x-data="agendaCalendar()">
    <h1 class="text-4xl font-bold text-teal-800 mb-8">Agenda del Gobernador</h1>

    <!-- Navegación de meses -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex items-center justify-between">
            <button @click="previousMonth()" class="flex items-center gap-2 px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Anterior
            </button>
            <h2 class="text-2xl font-semibold text-gray-800" x-text="currentMonthName + ' ' + currentYear"></h2>
            <button @click="nextMonth()" class="flex items-center gap-2 px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700 transition-colors">
                Siguiente
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Calendario mensual -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <!-- Días de la semana -->
        <div class="grid grid-cols-7 gap-2 mb-4">
            <div class="text-center font-semibold text-gray-600 py-2">Dom</div>
            <div class="text-center font-semibold text-gray-600 py-2">Lun</div>
            <div class="text-center font-semibold text-gray-600 py-2">Mar</div>
            <div class="text-center font-semibold text-gray-600 py-2">Mié</div>
            <div class="text-center font-semibold text-gray-600 py-2">Jue</div>
            <div class="text-center font-semibold text-gray-600 py-2">Vie</div>
            <div class="text-center font-semibold text-gray-600 py-2">Sáb</div>
        </div>

        <!-- Días del mes -->
        <div class="grid grid-cols-7 gap-2">
            <template x-for="day in calendarDays" :key="day.date">
                <div 
                    class="min-h-24 p-2 border rounded-md transition-colors"
                    :class="{
                        'bg-gray-50': !day.isCurrentMonth,
                        'bg-white': day.isCurrentMonth,
                        'hover:bg-teal-50': day.isCurrentMonth,
                        'bg-teal-100': day.isToday
                    }"
                >
                    <div class="text-sm font-medium" 
                         :class="{
                             'text-gray-400': !day.isCurrentMonth,
                             'text-teal-600': day.isToday
                         }"
                         x-text="day.day"></div>
                    
                    <template x-if="day.events.length > 0">
                        <div class="mt-1 space-y-1">
                            <template x-for="event in day.events" :key="event.id">
                                <div class="text-xs bg-teal-600 text-white px-2 py-1 rounded truncate cursor-pointer hover:bg-teal-700"
                                     x-text="event.title"
                                     @click="showEventDetails(event)"></div>
                            </template>
                        </div>
                    </template>
                </div>
            </template>
        </div>
    </div>

    <!-- Próximos eventos -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Próximos Eventos</h3>
        <div class="space-y-4">
            @forelse($upcomingEvents as $event)
                <div class="flex items-start gap-4 p-4 border rounded-md hover:bg-gray-50 transition-colors">
                    <div class="flex-shrink-0 w-16 h-16 bg-teal-600 text-white rounded-md flex flex-col items-center justify-center">
                        <span class="text-lg font-bold">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                        <span class="text-xs">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800">{{ $event->title }}</h4>
                        <p class="text-sm text-gray-600 mb-1">{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }} - {{ $event->time }}</p>
                        <p class="text-sm text-gray-500">{{ $event->location }}</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('agenda.export-google', $event) }}" target="_blank" class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors">
                            Google Calendar
                        </a>
                        <a href="{{ route('agenda.export-ical', $event) }}" class="px-3 py-1 bg-gray-600 text-white text-sm rounded hover:bg-gray-700 transition-colors">
                            iCal
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-4">No hay eventos próximos programados.</p>
            @endforelse
        </div>
    </div>

    <!-- Modal de detalles del evento -->
    <div x-show="selectedEvent" x-transition class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 p-6">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-xl font-bold text-gray-800" x-text="selectedEvent?.title"></h3>
                <button @click="selectedEvent = null" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="space-y-3">
                <div>
                    <span class="text-sm text-gray-500">Fecha:</span>
                    <span class="text-gray-800" x-text="selectedEvent?.date"></span>
                </div>
                <div>
                    <span class="text-sm text-gray-500">Hora:</span>
                    <span class="text-gray-800" x-text="selectedEvent?.time"></span>
                </div>
                <div>
                    <span class="text-sm text-gray-500">Lugar:</span>
                    <span class="text-gray-800" x-text="selectedEvent?.location"></span>
                </div>
                <div x-show="selectedEvent?.description">
                    <span class="text-sm text-gray-500">Descripción:</span>
                    <p class="text-gray-800" x-text="selectedEvent?.description"></p>
                </div>
            </div>
            <div class="mt-6 flex gap-2">
                <a :href="'/agenda/' + selectedEvent?.id + '/google'" target="_blank" class="flex-1 px-4 py-2 bg-blue-600 text-white text-center rounded hover:bg-blue-700 transition-colors">
                    Google Calendar
                </a>
                <a :href="'/agenda/' + selectedEvent?.id + '/ical'" class="flex-1 px-4 py-2 bg-gray-600 text-white text-center rounded hover:bg-gray-700 transition-colors">
                    iCal
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function agendaCalendar() {
    return {
        currentYear: {{ $year }},
        currentMonth: {{ $month }},
        events: @json($events),
        selectedEvent: null,

        get currentMonthName() {
            const months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
                          'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            return months[this.currentMonth - 1];
        },

        get calendarDays() {
            const days = [];
            const firstDay = new Date(this.currentYear, this.currentMonth - 1, 1);
            const lastDay = new Date(this.currentYear, this.currentMonth, 0);
            const startDay = firstDay.getDay();
            const totalDays = lastDay.getDate();

            // Días del mes anterior
            const prevMonthLastDay = new Date(this.currentYear, this.currentMonth - 1, 0).getDate();
            for (let i = startDay - 1; i >= 0; i--) {
                days.push({
                    day: prevMonthLastDay - i,
                    date: null,
                    isCurrentMonth: false,
                    isToday: false,
                    events: []
                });
            }

            // Días del mes actual
            const today = new Date();
            for (let i = 1; i <= totalDays; i++) {
                const dateStr = `${this.currentYear}-${String(this.currentMonth).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
                const dayEvents = this.events.filter(e => e.date === dateStr);
                const isToday = today.getFullYear() === this.currentYear && 
                               (today.getMonth() + 1) === this.currentMonth && 
                               today.getDate() === i;

                days.push({
                    day: i,
                    date: dateStr,
                    isCurrentMonth: true,
                    isToday: isToday,
                    events: dayEvents
                });
            }

            // Días del siguiente mes
            const remainingDays = 42 - days.length;
            for (let i = 1; i <= remainingDays; i++) {
                days.push({
                    day: i,
                    date: null,
                    isCurrentMonth: false,
                    isToday: false,
                    events: []
                });
            }

            return days;
        },

        previousMonth() {
            if (this.currentMonth === 1) {
                this.currentMonth = 12;
                this.currentYear--;
            } else {
                this.currentMonth--;
            }
            this.loadEvents();
        },

        nextMonth() {
            if (this.currentMonth === 12) {
                this.currentMonth = 1;
                this.currentYear++;
            } else {
                this.currentMonth++;
            }
            this.loadEvents();
        },

        loadEvents() {
            const url = new URL(window.location);
            url.searchParams.set('year', this.currentYear);
            url.searchParams.set('month', this.currentMonth);
            window.location = url;
        },

        showEventDetails(event) {
            this.selectedEvent = event;
        }
    };
}
</script>
@endsection
