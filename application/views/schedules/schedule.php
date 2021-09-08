<html>
	<head>
		<link href="/css/aquarius/stylesheets.css" rel="stylesheet" type="text/css" />
		<style>
			/*.fc-month-view span.fc-title{
				white-space:normal;
			}*/
		</style>
		<link rel='stylesheet' href='/css/fullcalendars/fullcalendar.css' />
<!--		<script src='/css/fullcalendars/lib/jquery-2.1.3.min.map'></script>
		<script src='/css/fullcalendars/lib/jquery.min.js'></script>-->
		<?php $this->load->view('schedules/head');?>
		<script src='/css/fullcalendars/lib/moment.min.js'></script>
		<script src='/css/fullcalendars/fullcalendar.js'></script>
		<script src='/js/aquarius/common.js'></script>
		<script src='/js/aquarius/links.js'></script>
	</head>
	<body>
		<div class="header">
			<a class="logo" href="/"><img src="/img/aquarius/logo.png" alt="Padinet" title="Padinet"/></a>
			<ul class="header_menu">
				<li class="list_icon"><a href="#">&nbsp;</a></li>
			</ul>
		</div>
		<?php $this->load->view('adm/menu');?>
		<div class="content">
			<div class="breadLine">
				<ul class="breadcrumb">
					<li><a href="#">App</a> <span class="divider">></span></li>                
					<li><a href="#">Agenda</a> <span class="divider">></span></li>                
					<li class="active">Kalendar</li>
				</ul>
			</div>
			<div>
				<span style="background:yellow;padding:10px;margin:10px;">Survey</span>
				<span style="background:green;padding:10px;margin:10px;">Instalasi</span>
				<span style="background:red;padding:10px;margin:10px;">Troubleshoots</span>
				<span style="background:skyblue;padding:10px;margin:10px;">Maintenance Pelanggan</span>
				<span style="background:blue;padding:10px;margin:10px;">Maintenance Non Pelanggan</span>
			</div>
			<div class="workplace">
				<div id="calendar"></div>
			</div>
		</div>
		<script>
		$(document).ready(function() {
			var date = new Date();
			var d = date.getDate();
			var m = date.getMonth();
			var y = date.getFullYear();
			console.log("new date:"+new Date());
			console.log("new date="+new Date(y, m, 20));
			$.ajax({
				url:thisdomain+"schedules/getJson",
			}).done(function(data){
				console.log(data);
				$('#calendar').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,basicWeek,agendaDay'
					},
					theme:true,
					defaultDate: getCurrentDate(),
					defaultView:'month',
					editable: true,
					allDay:false,
					disableDragging:true,
					editable:false,
					eventLimit: true, // allow "more" link when too many events
					events:JSON.parse(data),
					monthNames: ["Januari","Februari","Maret","April","Mei","Juni","Juli", "Agustus", "September", "Oktober", "Nopember", "Desember" ],
					monthNamesShort: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nop','Des'],
					dayNames: [ 'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
					dayNamesShort: ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
					buttonText: {
						today: 'Sekarang',
						month: 'Bulan',
						week: 'Minggu',
						day: 'Hari'
					},
					eventMouseover:function(data,event,view){
						tooltip="<div id='mytooltip' ";
						tooltip+="style='width:auto;height:auto;";
						tooltip+="background:#feb811;";
						tooltip+="position:absolute;";
						tooltip+="z-index:10001;";
						tooltip+="padding:10px 10px 10px 10px ;";
						tooltip+="  line-height: 200%;'>";
						tooltip+=data.title;
						tooltip+="</div>";
						$("body").append(tooltip);
						$(this).mouseover(function(e){
							$(this).css('z-index',10000);
							$("#mytooltip").fadeIn('500');
							$("#mytooltip").fadeTo('10',1.9);
						})
						.mousemove(function(e){
							$("#mytooltip").css('top',e.pageY+10);
							$("#mytooltip").css('left',e.pageX+10);
						})
					},
					eventMouseout:function(data,event,view){
						$(this).css('z-index',8);
						$("#mytooltip").remove();
					}
				});
			}).fail(function(){
				console.log("Cannot retrieve data");
			});

		});
		</script>
	</body>
</html>
