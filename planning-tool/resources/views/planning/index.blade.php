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
                @include('layouts.create_modal')
                @include('layouts.delete_modal')

            </div>
        </div>
    </div>

@push('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js'></script>
        <script>
            document.getElementById("popup-close-btn").addEventListener("click", function() {
                var modal = document.getElementById("popup-modal");
                modal.style.display = "none";
            });

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
                    eventContent: function (args) {
                        var event = args.event;
                        var title = event.title.split(' - ').join('<br>');
                        return {
                            html: title,
                        };
                    },
                    select: function(info) {
                        var start = info.start;
                        var end = info.end;
                        var modal = document.getElementById("popup-modal");
                        var overlay = document.getElementById('overlay');
                        var closeButton = document.getElementById('popup-close-btn');

                        modal.style.display = "block";
                        overlay.style.display = 'block';
                        document.getElementById("datum").value = start.toISOString().slice(0,10);
                        document.getElementById("beginuur").value = start.toTimeString().slice(0,5);
                        document.getElementById("einduur").value = end.toTimeString().slice(0,5);
                        closeButton.addEventListener('click', function() {
                            overlay.style.display = 'none';
                            modal.style.display = 'none';
                        });
                        document.getElementById('vak').addEventListener('change', function() {
                            var vak_value = this.value;
                            var vak = @json($vakken->toArray())
                        .find(function(vak) { return vak.naam === vak_value; });
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
                    eventClick: function(info) {
                        if (confirm('Weet u zeker dat u dit evenement wilt verwijderen?')) {
                            var eventId = info.event.id;
                            // Ajoutez un champ caché pour stocker l'ID de l'événement
                            var deleteForm = document.createElement('form');
                            deleteForm.method = 'POST';
                            deleteForm.action = '/planning/' + eventId;
                            var csrfInput = document.createElement('input');
                            csrfInput.type = 'hidden';
                            csrfInput.name = '_token';
                            csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                            deleteForm.appendChild(csrfInput);
                            var deleteMethodInput = document.createElement('input');
                            deleteMethodInput.type = 'hidden';
                            deleteMethodInput.name = '_method';
                            deleteMethodInput.value = 'DELETE';
                            deleteForm.appendChild(deleteMethodInput);
                            document.body.appendChild(deleteForm);
                            deleteForm.submit();
                        }

                    }


                });

                calendar.addEventSource(@json($calendarEvents));

                calendar.render();
            });
        </script>
    @endpush
</x-app-layout>
