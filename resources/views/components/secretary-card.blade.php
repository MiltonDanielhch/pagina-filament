{{--
    Componente: Tarjeta de Secretaría
--}}
@props(['secretariat'])

<a href="{{ route('institutional.secretariats.show', $secretariat->slug) }}"
   class="group block bg-white rounded-2xl p-5 shadow-sm hover:shadow-xl transition border border-gray-100 hover:border-{{ $secretariat->color ?? 'teal' }}-300">
    <div class="flex items-center gap-3 mb-3">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-sm shadow-sm"
             style="background-color: {{ $secretariat->color ?? '#0d9488' }}">
            {{ $secretariat->acronym ?? mb_substr($secretariat->name, 0, 2) }}
        </div>
        <div class="min-w-0 flex-1">
            <h3 class="text-sm font-bold text-gray-900 group-hover:text-teal-700 transition line-clamp-1">
                {{ $secretariat->name }}
            </h3>
        </div>
    </div>
    @if($secretariat->description)
    <p class="text-xs text-gray-600 line-clamp-2">
        {{ \Illuminate\Support\Str::limit($secretariat->description, 80) }}
    </p>
    @endif
</a>
