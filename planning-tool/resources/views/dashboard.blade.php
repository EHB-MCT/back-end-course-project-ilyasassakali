<x-app-layout>
    <style>
        @include('components.popover')
    </style>
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
                        },
                        eventDidMount: function(info) {
                            var event = info.event;
                            var title = event.title;
                            var start = event.start;
                            var end = event.end;

                            var formattedStart = start.toLocaleString('nl-NL', {
                                weekday: 'short',
                                month: 'short',
                                day: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit'
                            });

                            var formattedEnd = end.toLocaleString('nl-NL', {
                                weekday: 'short',
                                month: 'short',
                                day: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit'
                            });

                            var popover = document.createElement('div');
                            popover.className = 'popover bottom';
                            popover.innerHTML = `
                        <p><strong>Info:</strong> ${title}</p>
                        <p><strong>Begin:</strong> ${formattedStart}</p>
                        <p><strong>Einde:</strong> ${formattedEnd}</p>`;

                            info.el.appendChild(popover);
                            info.el.addEventListener('mouseenter', function() {
                                popover.style.display = 'block';
                            });
                            info.el.addEventListener('mouseleave', function() {
                                popover.style.display = 'none';
                            });
                        }

                    });

                    calendar.addEventSource(@json($calendarEvents));

                    calendar.render();
                });
            </script>
    @endpush

</x-app-layout>
