<x-mail::message>
# Timetable

**{{ $startDate->format('d.m.Y') }} – {{ $endDate->format('d.m.Y') }}**

@foreach($timetableEvents as $day => $events)

## {{ ucfirst($day) }}

@foreach($events as $event)
### {{ $event['nameEt'] ?? $event['nameRu'] ?? 'Lesson' }}

**{{ $event['timeStart'] }} - {{ $event['timeEnd'] ?? '' }}**

**Teacher:** {{ $event['teachers'][0]['name'] ?? 'Not specified' }}

**Room:** {{ $event['rooms'][0]['roomCode'] ?? 'Not specified' }}

**Group:** {{ $event['studentGroups'][0]['code'] ?? 'Not specified' }}

@endforeach

@endforeach

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>