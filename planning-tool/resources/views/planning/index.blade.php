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
                    <h2>Selecteer en klik om de planning op te stellen:</h2>
                    @if(session('success-message'))
                        <div class="" style="color: green">
                            {{ session('success-message') }}
                        </div>
                    @endif
                    <div id='calendar'></div>
                </div>
                @include('layouts.admin.create_modal')
                @include('layouts.admin.delete_modal')
                @include('layouts.admin.edit_modal')
            </div>
        </div>
    </div>

    @push('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js'></script>
        <script>

            document.getElementById("popup-close-btn").addEventListener("click", function () {
                var modal = document.getElementById("popup-modal");
                modal.style.display = "none";
            });

            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: 'nl',
                    initialView: 'timeGridWeek',
                    slotMinTime: '8:00:00',
                    slotMaxTime: '22:00:00',
                    selectable: true,
                    weekends: false,
                    slotLabelFormat: {
                        hour: 'numeric',
                        minute: '2-digit',
                        omitZeroMinute: false,
                        meridiem: 'short'
                    },
                    eventContent: function (args) {
                        var event = args.event;
                        var title = event.title.split(' - ').join('<br>');
                        return {
                            html: title,
                        };
                    },
                    select: function (info) {
                        var start = info.start;
                        var end = info.end;
                        var modal = document.getElementById("popup-modal");
                        var overlay = document.getElementById('overlay');
                        var closeButton = document.getElementById('popup-close-btn');

                        modal.style.display = "block";
                        overlay.style.display = 'block';
                        document.getElementById("datum").value = start.toISOString().slice(0, 10);
                        document.getElementById("beginuur").value = start.toTimeString().slice(0, 5);
                        document.getElementById("einduur").value = end.toTimeString().slice(0, 5);
                        closeButton.addEventListener('click', function () {
                            overlay.style.display = 'none';
                            modal.style.display = 'none';
                        });
                        document.getElementById('vak').addEventListener('change', function () {
                            var vak_value = this.value;
                            var vak = @json($vakken->toArray())
                        .
                            find(function (vak) {
                                return vak.naam === vak_value;
                            });
                            if (vak) {
                                document.getElementById('vak_id').value = vak.id;
                                document.getElementById('duur_div').style.display = 'block';
                                document.getElementById('sessies_div').style.display = 'block';
                                document.getElementById('duur').value = vak.duur;
                                document.getElementById('sessies').value = vak.sessies;
                            } else {
                                document.getElementById('duur_div').style.display = 'none';
                                document.getElementById('sessies_div').style.display = 'none';
                                document.getElementById('duur').value = '';
                                document.getElementById('sessies').value = '';
                            }
                        });
                    },
                    eventClick: function (info) {
                        var eventData = info.event;
                        var eventId = info.event.id;
                        var deleteModal = document.getElementById("delete-modal");
                        var deleteOverlay = document.getElementById("delete-overlay");
                        var deleteCloseButton = document.getElementById("delete-close-btn");
                        var deleteForm = document.getElementById("delete-form");
                        deleteForm.action = '/planning/' + eventId;
                        deleteModal.style.display = "block";
                        deleteOverlay.style.display = "block";
                        deleteCloseButton.addEventListener('click', function () {
                            deleteOverlay.style.display = 'none';
                            deleteModal.style.display = 'none';
                        });
                        document.getElementById("edit-datum").value = eventData.startStr.slice(0, 10);
                        document.getElementById("edit-beginuur").value = eventData.startStr.slice(11, 16);
                        document.getElementById("edit-einduur").value = eventData.endStr.slice(11, 16);
                        var titleParts = eventData.title.split(' - ');
                        document.getElementById("edit-vak").value = titleParts[0];
                        document.getElementById("edit-leerkracht").value = titleParts[2];
                        document.getElementById("edit-lokaal").value = titleParts[3];

                        document.getElementById("update-redirect-btn").addEventListener("click", function () {
                            var deleteModal = document.getElementById("delete-modal");
                            var deleteOverlay = document.getElementById("delete-overlay");
                            var editModal = document.getElementById("edit-modal");

                            deleteModal.style.display = "none";
                            deleteOverlay.style.display = "none";

                            editModal.style.display = "block";
                            deleteOverlay.style.display = "block";
                        });

                        updateEditFields();


                        document.getElementById("edit-modal-close-btn").addEventListener("click", function () {
                            var editModal = document.getElementById("edit-modal");
                            var editOverlay = document.getElementById("delete-overlay");

                            editModal.style.display = "none";
                            editOverlay.style.display = "none";
                        });

                        document.getElementById('edit-vak').addEventListener('change', updateEditFields);

                        function updateEditFields() {
                            var vak_value = document.getElementById('edit-vak').value;
                            var vak = @json($vakken->toArray())
                        .find(function (vak) {
                                return vak.naam === vak_value;
                            });
                            if (vak) {
                                var eventId = info.event.id;
                                document.getElementById('edit-duur').value = vak.duur;
                                document.getElementById('edit-sessies').value = vak.sessies;
                                document.getElementById('update-vak_id').value = vak.id;
                                console.log(eventId);

                                const form = document.getElementById('edit-form');
                                const url = `/planning/`+ eventId;
                                form.setAttribute('action', url);
                            } else {
                                document.getElementById('edit-duur').value = '';
                                document.getElementById('edit-sessies').value = '';
                            }
                        }


                    }
                });
                calendar.addEventSource(@json($calendarEvents));
                calendar.render();

            });
        </script>
    @endpush
</x-app-layout>
