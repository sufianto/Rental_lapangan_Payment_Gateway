<!DOCTYPE html>
<html>

<head>
    {{-- <title>Laravel Fullcalender Tutorial Tutorial - raviyatechnical</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/icon_univ_bsi.png') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <style>
        /* Kontainer utama kalender */
/* Kontainer utama kalender */
#calendar {
    margin: 20px auto;
    padding: 10px;
    background-color: #ffffff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 100%;
}

/* Responsive style for calendar */
@media (max-width: 767px) {
    #calendar {
        width: 100%;
        margin: 10px 0;
    }
}

/* Header kalender */
.fc-toolbar {
    background-color: #447fbb; /* Warna hijau header */
    color: #ffffff;
    border-radius: 8px 8px 0 0;
    padding: 10px;
}

/* Tombol navigasi (prev, next, today) */
.fc-button {
    background-color: #ffffff;
    border: 1px solid #447fbb;
    color: #447fbb;
    padding: 5px 10px;
    border-radius: 4px;
    font-weight: bold;
}

.fc-button:hover {
    background-color: #447fbb;
    color: #ffffff;
}

/* Tabel kalender */
.fc table {
    width: 100%;
    border-collapse: collapse;
}

/* Header hari */
.fc th {
    text-align: center;
    background-color: #f1f1f1;
    color: #447fbb;
    padding: 10px;
    border: 1px solid #ddd;
}

/* Sel hari */
.fc td {
    border: 1px solid #ddd;
    text-align: center;
    vertical-align: top;
    padding: 8px;
    height: 100px;
}

/* Event di dalam kalender */
.fc-event {
    background-color: #447fbb;
    color: #ffffff;
    border-radius: 4px;
    padding: 5px;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
}

.fc-event:hover {
    background-color: #447fbb;
    cursor: pointer;
}

/* Hari ini */
.fc-state-highlight {
    background-color: #e8f5e9;
    border: 1px solid #447fbb;
    border-radius: 4px;
}

/* Akhir pekan (Sabtu dan Minggu) */
.fc-sat, .fc-sun {
    background-color: #f9fbe7;
    color: #447fbb;
}

/* Garis penanda waktu (jika digunakan) */
.fc-time-grid .fc-now-indicator {
    background-color: #447fbb;
    color: #ffffff;
}

/* Tombol dropdown */
.fc-button-group > .fc-button {
    margin: 0 2px;
}

/* Tooltip event */
.fc-event:hover .fc-event-tooltip {
    display: block;
    position: absolute;
    background: #447fbb;
    color: white;
    padding: 5px;
    border-radius: 4px;
    z-index: 9999;
}

.fc-title {
    font-family: 'Arial', sans-serif; /* Pilih font */
    font-size: 14px;
    font-weight: bold;
    color: #ffffff; /* Warna teks */
    padding: 2px 5px; /* Padding untuk ruang di sekitar teks */
    text-align: center; /* Teks di tengah */
    overflow: hidden; /* Jika teks terlalu panjang */
    text-overflow: ellipsis; /* Tambahkan "..." jika teks terlalu panjang */
    white-space: nowrap; /* Hindari baris baru */
}
    </style>

</head>

<body>
    @extends('backend.v_layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      
           
        <div class="card">
            <div class="card-body">
               
                <div class="container-fluid">
                    <h5 class="card-title">Daftar Booking</h5>
                <p>Jam operasional: 08:00 - 22:00</p>
                    <div id='calendar'></div>
                </div>
               
            </div>
        </div>
    </div>
</div>

    
    @endsection

    {{-- <script>
        $(document).ready(function() {

            var SITEURL = "{{ url('/') }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#calendar').fullCalendar({
                editable: false,
                events: SITEURL + "/penyewa/show/test",
                displayEventTime: false,
                editable: false,
                eventRender: function(event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    var title = prompt('Event Title:');
                    if (title) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                    }
                }

            });

        });
    </script> --}}
    <script>
        $(document).ready(function() {
            var SITEURL = "{{ url('/') }}";
    
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    
            var calendar = $('#calendar').fullCalendar({
                editable: false,
                events: SITEURL + "/v_penyewa/show", // URL untuk mengambil data event
                displayEventTime: false,
                eventRender: function(event, element) {
                    // Format waktu
                    var startTime = moment(event.start).format('HH:mm');
                    var endTime = moment(event.end).format('HH:mm');
    
                    // Tambahkan waktu ke tampilan event
                    var eventDetails = `<b>${event.title}</b><br>${startTime} - ${endTime}`;
                    element.find('.fc-title').html(eventDetails);
                },
                selectable: true,
                selectHelper: true,
                select: function(start, end) {
                    var title = prompt('Event Title:');
                    if (title) {
                        var startFormatted = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                        var endFormatted = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
    
                        // Lakukan sesuatu dengan data yang dipilih, seperti menyimpan ke database
                        console.log("Title: " + title);
                        console.log("Start: " + startFormatted);
                        console.log("End: " + endFormatted);
                    }
                }
            });
        });
    </script>
    

</body>

</html>
