<?php

/**
 * Ubicación: `app/Http/Controllers/AgendaController.php`
 *
 * Descripción: Controlador para página pública de agenda.
 *
 * Roadmap: 12-FUTURO.md — Agenda del gobernador
 */

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AgendaController extends Controller
{
    /**
     * Mostrar agenda pública con calendario mensual.
     */
    public function index(Request $request): View
    {
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);

        // Obtener eventos del mes
        $events = Agenda::published()
            ->public()
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->orderBy('date')
            ->orderBy('time')
            ->get();

        // Obtener eventos futuros para lista
        $upcomingEvents = Agenda::published()
            ->public()
            ->upcoming()
            ->orderBy('date')
            ->orderBy('time')
            ->take(5)
            ->get();

        return view('agenda.index', compact('events', 'upcomingEvents', 'year', 'month'));
    }

    /**
     * Exportar evento a iCal.
     */
    public function exportIcal(Agenda $agenda)
    {
        $startDate = \Carbon\Carbon::parse($agenda->date)->format('Ymd') . 'T' . $agenda->time;
        $endDate = \Carbon\Carbon::parse($agenda->date)->format('Ymd') . 'T' . date('His', strtotime($agenda->time . ' + 2 hours'));

        $ics = "BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Gobernación del Beni//Agenda//ES
CALSCALE:GREGORIAN
METHOD:PUBLISH
BEGIN:VEVENT
SUMMARY:{$agenda->title}
DESCRIPTION:{$agenda->description}
DTSTART:{$startDate}
DTEND:{$endDate}
LOCATION:{$agenda->location}
URL:{$agenda->url}
END:VEVENT
END:VCALENDAR";

        return response($ics)
            ->header('Content-Type', 'text/calendar')
            ->header('Content-Disposition', 'attachment; filename="agenda-' . $agenda->slug . '.ics"');
    }

    /**
     * Exportar evento a Google Calendar.
     */
    public function exportGoogleCalendar(Agenda $agenda)
    {
        $startDate = \Carbon\Carbon::parse($agenda->date)->format('Ymd') . 'T' . $agenda->time;
        $endDate = \Carbon\Carbon::parse($agenda->date)->format('Ymd') . 'T' . date('His', strtotime($agenda->time . ' + 2 hours'));

        $url = 'https://calendar.google.com/calendar/render?action=TEMPLATE';
        $url .= '&text=' . urlencode($agenda->title);
        $url .= '&dates=' . $startDate . '/' . $endDate;
        $url .= '&details=' . urlencode($agenda->description ?? '');
        $url .= '&location=' . urlencode($agenda->location);

        return redirect($url);
    }
}
