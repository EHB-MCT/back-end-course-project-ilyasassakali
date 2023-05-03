<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agenda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Bekijk hier de live Agenda!") }}
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
                        weekends: false,
                        slotLabelFormat: {
                            hour: 'numeric',
                            minute: '2-digit',
                            omitZeroMinute: false,
                            meridiem: 'short'
                        },
                        eventDisplay: 'auto',
                        eventContent: function (args) {
                            var event = args.event;
                            var title = event.title.split(' - ').join('<br>');
                            return {
                                html: title,
                            };
                        }

                    });

                    calendar.addEventSource(@json($calendarEvents));

                    calendar.render();
                });
            </script>
    @endpush

</x-app-layout>
