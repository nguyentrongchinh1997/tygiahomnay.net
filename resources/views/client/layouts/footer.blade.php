		<footer>
			<p>
				© {{ date('Y') }}, Tygiahomnay.net - Website cập nhật nhanh giá cả thị trường.
			</p>
			
		</footer>
	</body>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link href="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/css/datepicker3.css" rel="stylesheet"/>
	<script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/bootstrap-datepicker.js"></script>
	<script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/locales/bootstrap-datepicker.it.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$.fn.datepicker.dates['en'] = {
			    days: ["Chủ nhật", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7"],
			    daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
			    daysMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
			    months: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
			    monthsShort: ["Th1", "Th2", "Th3", "Th4", "Th5", "Th6", "Th7", "Th8", "Th9", "Th10", "Th11", "Th12"],
			    today: "Hôm nay",
			    clear: "Xóa",
			    format: "dd-mm-yyyy",
			    titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
			    weekStart: 0
			};
		     $.fn.datepicker.defaults.language = 'en';
		});

		$(document).ready(function(){
		    $('.datepicker').datepicker();
		});
	</script>
	<script src="{{ asset('js/client.js') }}"></script>
</html>