<script src={{ asset("vendors/scripts/core.js") }}></script>
<script src={{ asset("vendors/scripts/script.min.js") }}></script>
{{-- <script src={{ asset("vendors/scripts/process.js") }}></script> --}}
<script src={{ asset("vendors/scripts/layout-settings.js") }}></script>
<script src={{ asset("src/scripts/dialog.js") }}></script>
<?php
$segmentUrl = Request::segment(2);

if ($segmentUrl === "dashboard") {
?>
<script src={{ asset("src/plugins/apexcharts/apexcharts.min.js") }}></script>
<script src={{ asset("vendors/scripts/dashboard.js") }}></script>
<?php
}
?>
<script src={{ asset("src/scripts/swal2.js") }}></script>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js" integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src={{ asset("src/plugins/datatables/js/jquery.dataTables.min.js") }}></script>
<script src={{ asset("src/plugins/datatables/js/dataTables.bootstrap4.min.js") }}></script>
<script src={{ asset("src/plugins/datatables/js/dataTables.responsive.min.js") }}></script>
<script src={{ asset("src/plugins/datatables/js/responsive.bootstrap4.min.js") }}></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/12.1.2/highcharts.js" integrity="sha512-eIPFJBK9Ncm6VV4QbelONNYxu+ZqScX5soG+972/XdjfwYiDlOzw4Sf08XidqScjlBOnm3PDUY8aBm/dOxyiMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/quill-better-table@1.2.8/dist/quill-better-table.min.js"></script>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
        style="display: none; visibility: hidden"></iframe></noscript>

<script type="text/javascript">
const rupiahInput = document.querySelector('.rupiahInput');

if (typeof CKEDITOR !== 'undefined') {
    // Disable notifications
    CKEDITOR.config.notification = { show: function() {} };
    
    // Cancel all notifications
    CKEDITOR.on('instanceCreated', function(event) {
        event.editor.on('notificationShow', function(evt) {
            evt.cancel();
        });
    });
    
    // Remove problematic plugins
    CKEDITOR.config.removePlugins = 'autosave,flash,iframe';
}

$(document).ready(function() {
            // Initialize DateRangePicker
    // $('.dateRange').daterangepicker({
    //     opens: 'right', // or 'left', 'center'
    //     startDate: moment().subtract(29, 'days'),
    //     endDate: moment(),
    //     minDate: '01/01/2015',
    //     maxDate: '12/31/2025',
    //     locale: {
    //         format: 'YYYY/MM/DD',
    //         applyLabel: 'Apply',
    //         cancelLabel: 'Cancel',
    //         fromLabel: 'From',
    //         toLabel: 'To',
    //         customRangeLabel: 'Custom',
    //         daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
    //         monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    //         firstDay: 1
    //     },
    //     ranges: {
    //         'Today': [moment(), moment()],
    //         'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    //         'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    //         'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    //         'This Month': [moment().startOf('month'), moment().endOf('month')],
    //         'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    //     }
    // }, function(start, end, label) {
    //     // Callback function when dates are selected
    //     $('#selectedRange').html('You selected: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    // });
});

function loadStates(){
    $(".disabled-button").show();
    $(".shows-button").hide();
    $(".disabled-btn").show();
}

function showStates(){
    $(".disabled-button").show();
    $(".shows-button").hide();
}

function cekCredentials(){
    let segmentUrl = "{{ Request::segment(2) }}";
    let _token = "{{ csrf_token() }}";

    let urlPost = "{{ route('getAccessCred') }}";

    $.ajax({
        type: "POST",
        data: "url="+segmentUrl+"&_token="+_token,
        url: urlPost,
        dataType: "json",
        success:function(data){
            if(data.status === 500){
                window.location = "{{ Route('dashboard') }}";
            }
        }
    })
}

cekCredentials();

$("#frm-pencarian-laporan").submit(function(e){
    e.preventDefault();

    let urlPost = "{{ route('post-pencarian-laporan') }}";

    $.ajax({
        type: "POST",
        data: "val="+$("#cmb-laporan-periode").val(),
        url: urlPost,
        dataType: "json",
        success:function(data){
            console.log("consoled" , data);
        }
    })
});

function getNotif(){
    $("#dis-notif-button").show();
    $("#shows-notif-button").hide();


    $("#ul-notifications-new").html("");
    $.ajax({
        type: "GET",
        url: "{{ route('getNotif') }}",
        data: "",
        dataType: "json",
        success:function(response){
            $("#ul-notifications-new").html(response.data);

            $("#dis-notif-button").hide();
            $("#shows-notif-button").show();
        }
    })
}

$('.dropdown-menu').on('click', 'select, input, label, button', function (e) {
  e.stopPropagation();
});

function getNotifNew(event){
    $("#dis-notif-button").show();
    $("#shows-notif-button").hide();

    event.stopPropagation();

    $("#ul-notifications-new").html("");
    $.ajax({
        type: "GET",
        url: "{{ route('getNotif') }}",
        data: "tipe="+$("#cmb-notif-type").val(),
        dataType: "json",
        success:function(response){
            $("#ul-notifications-new").html(response.data);

            $("#dis-notif-button").hide();
            $("#shows-notif-button").show();
        }
    })
}

getNotif();

if(rupiahInput !== null){
    rupiahInput.addEventListener('input', function (e) {
        // Hapus semua karakter selain angka
        let value = e.target.value.replace(/[^0-9]/g, '');

        // Format nilai ke dalam format Rupiah
        if (value.length > 0) {
            value = parseInt(value, 10).toLocaleString('id-ID');
        } else {
            value = '';
        }

        // Set nilai input dengan format Rupiah
        e.target.value = value ? `Rp ${value}` : '';
    });

    rupiahInput.addEventListener('blur', function (e) {
        // Jika input kosong, set ke Rp 0
        if (e.target.value === '') {
            e.target.value = 'Rp 0';
        }
    });

    rupiahInput.addEventListener('focus', function (e) {
        // Hapus "Rp" saat input difokuskan
        if (e.target.value === 'Rp 0') {
            e.target.value = '';
        }
    });
}

var sampleArray = [{
    id: 0,
    text: 'enhancement'
}, {
    id: 1,
    text: 'bug'
}, {
    id: 2,
    text: 'duplicate'
}, {
    id: 3,
    text: 'invalid'
}, {
    id: 4,
    text: 'wontfix'
}];

$(document).ready(function() {

    function loadStates(){
        $("#disabled-button").show();
        $("#shows-button").hide();
    }

    function showStates(){
        $("#disabled-button").show();
        $("#shows-button").hide();
    }

    function hideStates(){
        $("#disabled-button").hide();
        $("#shows-button").show();
    }

    function loadNotif(){
        $("#dis-notif-button").show();
        $("#shows-notif-button").hide();
    }

    function showStates(){
        $("#dis-notif-button").show();
        $("#shows-notif-button").hide();
    }

    getNotif();

    loadStates();

});
</script>

<script type="module">
import {
    initializeApp
} from "https://www.gstatic.com/firebasejs/11.0.1/firebase-app.js";
import {
    getMessaging,
    getToken,
    onMessage
} from "https://www.gstatic.com/firebasejs/11.0.1/firebase-messaging.js"

// Your web app's Firebase configuration
/*
const firebaseConfig = {
    apiKey: "AIzaSyCxBVoWvn7wKUr-QBllpXg1nQ62H_KU5j8",
    authDomain: "halogen-inkwell-825.firebaseapp.com",
    databaseURL: "https://halogen-inkwell-825.firebaseio.com",
    projectId: "halogen-inkwell-825",
    storageBucket: "halogen-inkwell-825.appspot.com",
    messagingSenderId: "509301698144",
    appId: "1:509301698144:web:55c3be6b1c8de92f0ddd05"
};
*/

const firebaseConfig = {
    apiKey: "AIzaSyAaG3gnI6JJAYbWyjx-5JYEnlIFG3NJ_Kc",
    authDomain: "letter-api.firebaseapp.com",
    projectId: "letter-api",
    storageBucket: "letter-api.appspot.com",
    messagingSenderId: "38638047951",
    appId: "1:38638047951:web:9aa7518c96a5e88cbd9dba",
    measurementId: "G-MG7RTFBXN1"
};

const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

const requestPermissionAndGetToken = async () => {
    try {
        const token = await getToken(messaging, {
            vapidKey: "BADV83Pvub96khiq1Ft3qCzi7ZDSD1bXP6KvYVdaVqAnqt_iJswVXnpBg_curEqNRDldPYArFozgCn6jfeCRUvU"
        });
        fetch('/send-message', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                token: token
            })
        });
    } catch (error) {
        console.error("Error getting token:", error);
    }
};

// document.getElementById("enable-notifications").addEventListener("click", () => {
//     if (Notification.permission === "granted") {
//         requestPermissionAndGetToken();
//     } else if (Notification.permission === "default") {
//         requestNotificationPermission();
//     } else {
//         console.log("Notifications are blocked. Please enable them in the browser settings.");
//     }
// });

function requestNotificationPermission() {
    Notification.requestPermission().then(permission => {
        if (permission === "granted") {
            requestPermissionAndGetToken();
        } else {
            console.log("Notifications permission denied.");
        }
    });
}

onMessage(messaging, (payload) => {
    console.log("Message received:", payload);
    // Display notification to the user if needed
    new Notification(payload.notification.title, {
        body: payload.notification.body,
        icon: payload.notification.icon,
    });
});

</script>