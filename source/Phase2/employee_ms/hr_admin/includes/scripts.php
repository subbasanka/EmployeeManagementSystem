<script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/js-cookie/js.cookie.js"></script>
<script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Optional JS -->
<script src="../assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="../assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="../assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="../assets/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
<script src="../assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- Argon JS -->
<script src="../assets/js/argon.js?v=1.1.0"></script>
<!-- Demo JS - remove this in your project -->
<script src="../assets/js/demo.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>
//
// Notify


	function notify(type, message) {
        if(type=='success'){
            var title = 'Success'
        }else if(type=='danger'){
            var title = 'Error';
        }
        
		$.notify({
			icon: 'ni ni-bell-55',
			title: title,
			message: message,
			url: ''
		}, {
			element: 'body',
			type: type,
			allow_dismiss: true,
			placement: {
				from: 'top',
				align: 'center'
			},
			offset: {
				x: 15, // Keep this as default
				y: 15 // Unless there'll be alignment issues as this value is targeted in CSS
			},
			spacing: 10,
			z_index: 1080,
			delay: 2500,
			timer: 25000,
			url_target: '_blank',
			mouse_over: false,
			animate: {
				enter: 'animated fadeInDown',
		        exit: 'animated fadeOutUp'
			},
			template: '<div data-notify="container" class="alert alert-dismissible alert-{0} alert-notify" role="alert">' +
				'<span class="alert-icon" data-notify="icon"></span> ' +
                '<div class="alert-text"</div> ' +
				'<span class="alert-title" data-notify="title">{1}</span> ' +
				'<span data-notify="message">{2}</span>' +
                '</div>' +
				// '<div class="progress" data-notify="progressbar">' +
				// '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
				// '</div>' +
				// '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '<button type="button" class="close" data-notify="dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
				'</div>'
		});
	}

	// Show notify
    <?php if(isset($alert)){ echo $alert; } ?>


//
// Onscreen - viewport checker
//

'use strict';

var OnScreen = (function() {
    // Variables
    var $onscreen = $('[data-toggle="on-screen"]');
    // Methods
    function init($this) {
		var options = {
            container: window,
            direction: 'vertical',
            doIn: function() {
                //alert();
            },
            doOut: function() {
                // Do something to the matched elements as they get off scren
            },
            tolerance: 200,
            throttle: 50,
            toggleClass: 'on-screen',
            debug: false
		};

		$this.onScreen(options);
	}

    // Events
    if ($onscreen.length) {
		init($onscreen);
	}

})();
</script>