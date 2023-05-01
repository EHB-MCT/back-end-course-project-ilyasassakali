<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Planningopstel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2>Selecteer om planning op te stellen of veranderingen te maken:</h2>
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    locale:'nl',
                    initialView: 'timeGridWeek',
                    slotMinTime: '8:00:00',
                    slotMaxTime: '22:00:00',
                    selectable : true,
                    weekends: false,
                    slotLabelFormat: {
                        hour: 'numeric',
                        minute: '2-digit',
                        omitZeroMinute: false,
                        meridiem: 'short'
                    },
                    select: function(info) {
                        var start = new Date(info.start);
                        var end = new Date(info.end);
                        var startFormatted = start.getDate() + '/' + (start.getMonth() + 1) + '/' + start.getFullYear() + ' ' + start.getHours() + ':' + start.getMinutes();
                        var endFormatted = end.getDate() + '/' + (end.getMonth() + 1) + '/' + end.getFullYear() + ' ' + end.getHours() + ':' + end.getMinutes();
                        alert('Geselecteerd van ' + startFormatted + ' tot ' + endFormatted);

                    },
                    events: [
                        {
                            id: 1,
                            title: 'Mon événement',
                            start: '2023-05-01T08:00:00',
                            end: '2023-05-01T10:00:00'
                        }
                    ],
                });
                calendar.render();
            });
        </script>
    @endpush
</x-app-layout>
