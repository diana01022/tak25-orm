<x-mail::message>
# Timetable

**{{ $startDate->format('d.m.Y') }} – {{ $endDate->format('d.m.Y') }}**

@foreach($timetableEvents as $day => $events)

## {{ ucfirst($day) }}

@foreach($events as $event)
**{{ $event['timeStart'] }} - {{ $event['timeEnd'] ?? '' }}**

{{ $event['nameEt'] ?? $event['nameRu'] ?? 'Lesson' }}

@endforeach

@endforeach

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>