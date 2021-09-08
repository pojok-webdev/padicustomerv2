<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("adm/head");?>
<body>
	<?php $this->load->view('adm/header'); ?>
	<link rel="stylesheet" type="text/css" href="/css/teknis.css"/>
	<link rel="stylesheet" type="text/css" href="/js/autocomplete/styles.css"/>
    <script type="text/javascript" src="/js/autocomplete/jquery.autocomplete.js"></script>    
    <script type="text/javascript" src="/js/padilibs/padi.autocomplete.js"></script>    
	<?php $this->load->view('adm/menu'); ?>
    <div class="content">
        <div class="breadLine">
            <ul class="breadcrumb">
                <li><a href="#">Laporan</a> <span class="divider">></span></li>
                <li class="active">Filter</li>
            </ul>
		<?php $this->load->view('adm/buttons'); ?>
        </div>
        <div class="workplace">
			<input type="hidden" id="userbranches" value="<?php echo $userbranches;?>" />
            <div class="row-fluid">
                <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-documents"></div>
                        <h1>Filter</h1>
                    </div>
                    <div class="block-fluid">
						<?php if(1===1){?>
                        <div class="row-form clearfix">
                            <div class="span3">Rekap Bulan:</div>
                            <div class="span2">
								<input type="text" class="monthdatepicker" id="reportdate" value ="<?php echo date("F - Y");?>">
							</div>
                            <div class="span1"><button class="btn" type="button" id="viewmonthlyreport">View</button></div>
                            <div class="span6"></div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Laporan Tiket Harian:</div>
                            <div class="span2"><input type="text" class="datepicker" id="shiftdate" value="<?php echo date("d/m/Y");?>"></div>
                            <div class="span1">
							<button class="btn" type="button" id="viewshiftreport">View</button>
							</div>
                            <div class="span6"></div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Laporan Tiket Periodik:</div>
                            <div class="span6">
								<input type="text" class="datepicker" id="periodicticketreport1" value="<?php echo date("d/m/Y");?>">
								<input type="text" class="datepicker" id="periodicticketreport2" value="<?php echo date("d/m/Y");?>">
							</div>
                            <div class="span1">
								<button class="btn" type="button" id="viewperiodicticketreport">View</button>
							</div>
                            <div class="span2"></div>
                        </div>
						
                        <div class="row-form clearfix">
                            <div class="span3">Laporan Komplain Per Shift:</div>
                            <div class="span6">
								<input type="text" class="datepicker" id="shiftticketreport1" value="<?php echo date("d/m/Y");?>">
								<input type="text" class="datepicker" id="shiftticketreport2" value="<?php echo date("d/m/Y");?>">
							</div>
                            <div class="span1">
								<button class="btn" type="button" id="viewshiftticketreport">View</button>
							</div>
                            <div class="span2"></div>
                        </div>

                        <div class="row-form clearfix">
                            <div class="span3">Laporan Kategori Komplain:</div>
                            <div class="span6">
								<input type="text" class="datepicker" id="periodiccategorycomplainreport1" value="<?php echo date("d/m/Y");?>">
								<input type="text" class="datepicker" id="periodiccategorycomplainreport2" value="<?php echo date("d/m/Y");?>">
							</div>
                            <div class="span1">
								<button class="btn" type="button" id="viewperiodiccategorycomplainreport">View</button>
							</div>
                            <div class="span2"></div>
                        </div>

                        <div class="row-form clearfix">
                            <div class="span3">Laporan Main Root Cause:</div>
                            <div class="span6">
								<input type="text" class="datepicker" id="periodicmainroot1" value="<?php echo date("d/m/Y");?>">
								<input type="text" class="datepicker" id="periodicmainroot2" value="<?php echo date("d/m/Y");?>">
							</div>
                            <div class="span1">
								<button class="btn" type="button" id="viewmainrootcausereport">View</button>
							</div>
                            <div class="span2"></div>
                        </div>

                        <div class="row-form clearfix">
                            <div class="span3">Nama Pelanggan:</div>
                            <div class="span6">
								<input type="text" id="autocomplete-pelanggan">
								<input type="text" id="client_id" style="display:none">
                            </div>
                            <div class="span1"><button class="btn" type="button" id="viewtickethistory">View</button></div>
                            <div class="span2"></div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Laporan Downtime:</div>
                            <div class="span6">
								<input type="text" class="datepicker" id="downtimedate1" value="<?php echo date("d/m/Y");?>">
								<input type="text" class="datepicker" id="downtimedate2" value="<?php echo date("d/m/Y");?>">
                            </div>
                            <div class="span1"><button class="btn" type="button" id="viewdowntimereport">View</button></div>
                            <div class="span2"></div>
                        </div>	
                        <div class="row-form clearfix">
                            <div class="span3">Laporan Ticket Terselesaikan:</div>
                            <div class="span6">
                            <div class="span6" style="display:none">
								<input type="text" class="datepicker" id="solveddate1" value="<?php echo date("d/m/Y");?>">
								<input type="text" class="datepicker" id="solveddate2" value="<?php echo date("d/m/Y");?>">
                            </div>
                            </div>
                            <div class="span1"><button class="btn" type="button" id="viewsolvedreport">View</button></div>
                            <div class="span2"></div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Laporan Ticket Open:</div>
                            <div class="span1"><button class="btn" type="button" id="viewopenticket">View</button></div>
                            <div class="span2"></div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Laporan Ticket Per Pelanggan:</div>
                            <div class="span1"><button class="btn" type="button" id="viewticketperpelanggan">View</button></div>
                            <div class="span2"></div>
						</div>
						

                        <div class="row-form clearfix">
                            <div class="span9">Banyaknya Pelanggan Per VAS:</div>
                            <div class="span1"><button class="btn" type="button" id="viewclientbyvas">View</button></div>
                            <div class="span2"></div>
                        </div>

						<div class="row-form clearfix">
						
                            <div class="span3">Laporan Top 5 Main Root Cause:</div>
                            <div class="span6">
								<input type="text" class="datepicker" id="periodtop51" value="<?php echo date("d/m/Y");?>">
								<input type="text" class="datepicker" id="periodtop52" value="<?php echo date("d/m/Y");?>">
                            </div>
                            <div class="span1"><button class="btn" type="button" id="viewtop5mainrootcause">View</button></div>
                            <div class="span2"></div>
                        </div>

						<div class="row-form clearfix">
						
                            <div class="span3">Laporan Top 5 Sub Root Cause:</div>
                            <div class="span6">
								<input type="text" class="datepicker" id="periodtopsub51" value="<?php echo date("d/m/Y");?>">
								<input type="text" class="datepicker" id="periodtopsub52" value="<?php echo date("d/m/Y");?>">
                            </div>
                            <div class="span1"><button class="btn" type="button" id="viewtop5subrootcause">View</button></div>
                            <div class="span2"></div>
                        </div>

						<div class="row-form clearfix">
						
                            <div class="span3">Laporan Durasi Bulanan:</div>
                            <div class="span2">
								<select class="mete" name="" id="monthlydurationyear">
									<?php for($y=2018;$y<=date("Y");$y++){?>
										<?php if($y==date("Y")){?>
											<option value="<?php echo $y;?>" selected="selected"><?php echo $y;?></option>
										<?php } else {?>
											<option value="<?php echo $y;?>"><?php echo $y;?></option>
										<?php }?>
									<?php }?>
								</select>
								</div><div class="span2">
								<select class="mete" name="monthlydurationmonth" id="monthlydurationmonth">
									<?php foreach($months2 as $x=>$y){?>
									<option value="<?php echo $x;?>"><?php echo $y;?></option>
									<?php }?>
								</select>
                            </div>
                            <div class="span3"><button class="btn" type="button" id="viewmonthlyduration">View</button></div>
                            <div class="span2"></div>
                        </div>
						<?php } ?>					
						<?php if($this->session->userdata["role"]=="Sales"){?>
                        <?php if(has_right_access(1,$this->session->userdata["user_id"])){?>
                        <div class="row-form clearfix">
                            <div class="span3">Rekap Bulanan Sales:</div>
                            <div class="span2"><input type="text" class="monthdatepicker" id="reportdatefarmer" value ="<?php echo date("F - Y");?>"></div>

                            <div class="span1"><button class="btn" type="button" id="viewmonthlyreportfarmer">View</button></div>
                            <div class="span6"></div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Laporan Harian Ticket:</div>
                            <div class="span2">
								<input type="text" class="datepicker" id="salesfilterdailyticket" value ="<?php echo date("d/m/Y");?>">
							</div>

                            <div class="span1"><button class="btn" type="button" id="salesdailyticket">View</button></div>
                            <div class="span6"></div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Laporan Tiket Periodik:</div>
                            <div class="span6">
								<input type="text" class="datepicker" id="salesperiodicticketreport1" value="<?php echo date("d/m/Y");?>">
								<input type="text" class="datepicker" id="salesperiodicticketreport2" value="<?php echo date("d/m/Y");?>">
							</div>
                            <div class="span1">
								<button class="btn" type="button" id="salesviewperiodicticketreport">View</button>
							</div>
                            <div class="span2"></div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Laporan Leads:</div>
                            <div class="span6">
								<input type="text" class="datepicker" id="suspectdate1" value="<?php echo date("d/m/Y");?>">
								<input type="text" class="datepicker" id="suspectdate2" value="<?php echo date("d/m/Y");?>">
                            </div>

                            <div class="span1"><button class="btn" type="button" id="viewsuspectreport">View</button></div>
                            <div class="span2"></div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Laporan Prospect:</div>
                            <div class="span6">
								<input type="text" class="datepicker" id="prospectdate1" value="<?php echo date("d/m/Y");?>">
								<input type="text" class="datepicker" id="prospectdate2" value="<?php echo date("d/m/Y");?>">
                            </div>

                            <div class="span1"><button class="btn" type="button" id="viewprospectreport">View</button></div>
                            <div class="span2"></div>
                        </div>
						
                        <div class="row-form clearfix">
                            <div class="span3">Laporan Survey:</div>
                            <div class="span6">
								<input type="text" class="datepicker" id="surveydate1" value="<?php echo date("d/m/Y");?>">
								<input type="text" class="datepicker" id="surveydate2" value="<?php echo date("d/m/Y");?>">
                            </div>

                            <div class="span1"><button class="btn" type="button" id="viewsurveyreport">View</button></div>
                            <div class="span2"></div>
                        </div>
						
                        <div class="row-form clearfix">
                            <div class="span3">Laporan Install:</div>
                            <div class="span6">
								<input type="text" class="datepicker" id="installdate1" value="<?php echo date("d/m/Y");?>">
								<input type="text" class="datepicker" id="installdate2" value="<?php echo date("d/m/Y");?>">
                            </div>
                            <div class="span1"><button class="btn" type="button" id="viewinstallreport">View</button></div>
                            <div class="span2"></div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span9">Laporan Pelanggan:</div>
                            <div class="span1"><button class="btn" type="button" id="viewclientreport">View</button></div>
                            <div class="span2"></div>
                        </div>
						<?php }?>
						<?php }?>
                    </div>
                </div>

            </div>


        </div>

    </div>
    <script type="text/javascript">
		var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
		$("#viewmonthlyreport").click(function(){
			console.log($("#reportdate").val());
			if($("#reportdate").val().trim()!==""){
				var dat = $("#reportdate").val(),
					sp = dat.split(" - "),
					mn = sp[0],yr = sp[1];
				console.log(mn,yr);
				month = months.indexOf(mn)+1;
				//window.location.href = "/rpt/layout/"+month+"/"+yr+"/"+$("#userbranches").val();
				window.open("/rpt/layout/"+month+"/"+yr+"/"+$("#userbranches").val(),"_blank");
			}
		});
		$("#viewmonthlyreportfarmer").click(function(){
			console.log($("#reportdatefarmer").val());
			if($("#reportdatefarmer").val().trim()!==""){
				var dat = $("#reportdatefarmer").val(),
					sp = dat.split(" - "),
					mn = sp[0],yr = sp[1];
				console.log(mn,yr);
				month = months.indexOf(mn)+1;
				//window.location.href = "/rpt/farmer/"+month+"/"+yr+"/"+$("#userbranches").val()+"/0";
				window.open("/rpt/farmer/"+month+"/"+yr+"/"+$("#userbranches").val()+"/0","_blank");
			}
		});
		$("#viewclientreport").click(function(){
			//window.location.href = '/rpt/clientreport';
			window.open("/rpt/clientreport","blank");
		});
		$("#viewclientbyvas").click(function(){
			//window.location.href = "/rpt/getvasclients";
			window.open("/rpt/getvasclients","_blank");
		})
		$("#viewticketperpelanggan").click(function(){
			console.log($("#reportdate").val());
			if($("#shiftdate").val().trim()!==""){
				var dat = $("#shiftdate").val(),
					sp = dat.split("/"),
					dt = sp[0],mn = sp[1],yr = sp[2];
					mn = mn-0;
				console.log("mn,yr",mn,yr);
//				window.location.href = "/rpt/complaintsperclient";
				window.open("/rpt/complaintsperclient","_blank")
			}
		});
		
		$("#viewshiftreport").click(function(){
			console.log($("#reportdate").val());
			if($("#shiftdate").val().trim()!==""){
				var dat = $("#shiftdate").val(),
					sp = dat.split("/"),
					dt = sp[0],mn = sp[1],yr = sp[2];
					mn = mn-0;
				console.log("mn,yr",mn,yr);
//				window.location.href = "/rpt/shiftreport/"+dt+"/"+mn+"/"+yr+"/"+$("#userbranches").val();
				window.open("/rpt/shiftreport/"+dt+"/"+mn+"/"+yr+"/"+$("#userbranches").val(),"_blank");
			}
		});
		$("#viewsolvedreport").click(function(){
			console.log($("#reportdate").val());
			$("#solveddate1").getdate();$("#solveddate2").getdate();
			if($("#shiftdate").val().trim()!==""){
				var dat = $("#shiftdate").val(),
					sp = dat.split("/"),
					dt = sp[0],mn = sp[1],yr = sp[2];
					mn = mn-0;
				console.log("mn,yr",mn,yr);
				//window.location.href = '/rpt/solvedreport4';
				//window.location.href = "/rpt/solvedreport/clientname/asc/14/4/"+$("#solveddate1").attr("datetime")+"/"+$("#solveddate2").attr("datetime");;
				window.open("/rpt/solvedreport4","_blank");
			}
		});		
		$("#viewunsolvedreport").click(function(){
			$("#unsolveddate1").getdate();
			$("#unsolveddate2").getdate();
			console.log($("#reportdate").val());
			if($("#shiftdate").val().trim()!==""){
				var dat = $("#shiftdate").val(),
					sp = dat.split("/"),
					dt = sp[0],mn = sp[1],yr = sp[2];
					mn = mn-0;
				console.log("mn,yr",mn,yr);
				//window.location.href = "/rpt/unsolvedreport/clientname/asc/14/4/"+$("#unsolveddate1").attr("datetime")+"/"+$("#unsolveddate2").attr("datetime");
				window.open("/rpt/unsolvedreport/clientname/asc/14/4/"+$("#unsolveddate1").attr("datetime")+"/"+$("#unsolveddate2").attr("datetime"),"_blank");
			}
		});	
		//	
		$("#viewopenticket").click(function(){
			$("#unsolveddate1").getdate();
			$("#unsolveddate2").getdate();
			console.log($("#reportdate").val());
			if($("#shiftdate").val().trim()!==""){
				var dat = $("#shiftdate").val(),
					sp = dat.split("/"),
					dt = sp[0],mn = sp[1],yr = sp[2];
					mn = mn-0;
				console.log("mn,yr",mn,yr);
				//window.location.href = "/rpt/showOpenTicket/clientname/asc/14/4/"+padicurdate()+"/"+padicurdate();
				window.open("/rpt/showOpenTicket/clientname/asc/14/4/"+padicurdate()+"/"+padicurdate(),"_blank");
			}
		});	

		$("#viewzabbix").click(function(){
			window.location.href = "/rpt/zabbix2";
		});
		$("#viewsla").click(function(){
			console.log($("#slamonth").val());
			if($("#slamonth").val().trim()!==""){
				var dat = $("#slamonth").val(),
					sp = dat.split(" - "),
					mn = sp[0],yr = sp[1];
				console.log(mn,yr);
				month = months.indexOf(mn)+1;
				window.location.href = "/rpt/sla/"+$("#services").val()+"/"+month+"/"+yr;
			}
//			window.location.href = "/rpt/sla/"+$("#services").val()+"/"+$("#slamonth").val();
		});
    
    </script>
    

    <script>
			'use strict';
			var pelanggan = [{"value":"Djamoe Iboe","data":1},{"value":"Djamoe Ayah","data":2},{"value":"Resto Nine","data":3}];
			$.ajax({
				url:thisdomain+'tickets/listtest',
				dataType:'json',
				success:function(clnts){
					pelanggan = clnts.out;
					console.log('out',clnts.out);

					$('#autocomplete-pelanggan').autocomplete({
						lookup: clnts.out,
						onSelect: function(suggestion) {
							$('#client_id').val(suggestion.data);
							$.ajax({
								url:thisdomain+'clients/get_sites',
								type:'post',
								data:{id:suggestion.data},
								dataType:'json',
								success:function(sites){
									$('#csites').empty();
									$.each(sites,function(x,y){
										$('#csites').append('<option value='+x+'>'+y.alamat+'</option>');
										$.ajax({
											url:thisdomain+'clients/get_services',
											type:'post',
											data:{id:x},
											dataType:'json',
											success:function(services){
												var myservices = '';
												$.each(services,function(x,y){
													myservices += y.name+' Tgl Aktivasi '+sql2idformatnotime(y.activation_date)+"<br />" ;
													console.log('myservices',myservices);
													//$('#autocomplete-pelanggan-x').html(y.name+' Tgl Aktivasi '+sql2idformat(y.activation_date));
												$('#autocomplete-pelanggan-x').html(myservices);
												});
												
											},
											error:function(err){
												alert(err);
											}
										});
									});
								},
								error:function(err){
									console.log('err',err);
								}
							});
						},
						onHint: function (hint) {
							console.log('hint',hint);
							$('#autocomplete-pelanggan-x').val(hint);
						},
						onInvalidateSelection: function() {
							//$('#selction-client').html('You selected: none');
						}
					});
				}
			});
    </script>
	<script>
		$("#viewtickethistory").click(function(){
			if($("#autocomplete-pelanggan").val().trim()===""){
				alert("Nama Pelanggan tidak boleh kosong")
			}else{
				console.log($('#client_id').val());
				//window.location.href = "/rpt/ticketbyname/asc/"+$('#client_id').val();
				window.open("/rpt/ticketbyname/asc/"+$('#client_id').val(),"_blank");
			}
		});
		$("#viewsuspectreport").click(function(){
			
			$("#suspectdate1").getdate();
			$("#suspectdate2").getdate();
			console.log($("#suspectdate1").attr("datetime"));
			//window.location.href = "/rpt/suspectreport/create_date/asc/"+$("#suspectdate1").attr("datetime")+"/"+$("#suspectdate2").attr("datetime")+"/"+$("#userbranches").val()+"/<?php echo $struser;?>";
			window.open("/rpt/suspectreport/create_date/asc/"+$("#suspectdate1").attr("datetime")+"/"+$("#suspectdate2").attr("datetime")+"/"+$("#userbranches").val()+"/<?php echo $struser;?>","_blank");
		});
		$("#viewprospectreport").click(function(){
			
			$("#prospectdate1").getdate();
			$("#prospectdate2").getdate();
			console.log($("#prospectdate1").attr("datetime"));
			//window.location.href = "/rpt/prospectreport/create_date/asc/"+$("#prospectdate1").attr("datetime")+"/"+$("#prospectdate2").attr("datetime")+"/"+$("#userbranches").val()+"/<?php echo $struser;?>";
			window.open("/rpt/prospectreport/create_date/asc/"+$("#prospectdate1").attr("datetime")+"/"+$("#prospectdate2").attr("datetime")+"/"+$("#userbranches").val()+"/<?php echo $struser;?>","_blank");
		});
		$("#viewsurveyreport").click(function(){
			$("#surveydate1").getdate();
			$("#surveydate2").getdate();
			console.log($("#surveydate1").attr("datetime"));
			window.open("/rpt/surveyreport/create_date/asc/"+$("#surveydate1").attr("datetime")+"/"+$("#surveydate2").attr("datetime")+"/"+$("#userbranches").val()+"/<?php echo $struser;?>","_blank");
		});
		$("#viewinstallreport").click(function(){
			$("#installdate1").getdate();
			$("#installdate2").getdate();
			console.log($("#installdate1").attr("datetime"));
			window.open("/rpt/installreport/create_date/asc/"+$("#installdate1").attr("datetime")+"/"+$("#installdate2").attr("datetime")+"/"+$("#userbranches").val()+"/<?php echo $struser;?>","_blank");
		});
		//viewdowntimereport
		$("#viewdowntimereport").click(function(){
			$("#downtimedate1").getdate();
			$("#downtimedate2").getdate();
			console.log($("#downtimedate1").attr("datetime"));
			window.open("/rpt/downtimereport/clientname/asc/"+$("#downtimedate1").attr("datetime")+"/"+$("#downtimedate2").attr("datetime")+"/"+$("#userbranches").val(),"_blank");
		});
		$("#viewperiodicticketreport").click(function(){
			if($("#periodicticketreport1").val().trim()!==""){
				var dat1 = $("#periodicticketreport1").val(),
					sp1 = dat1.split("/"),
					dt1 = sp1[0],mn1 = sp1[1],yr1 = sp1[2];
					mn1 = mn1-0,
					dat2 = $("#periodicticketreport2").val(),
					sp2 = dat2.split("/"),
					dt2 = sp2[0],mn2 = sp2[1],yr2 = sp2[2];
					mn2 = mn2-0;

				window.open("/rpt/shiftreportperiodic/"+dt1+"/"+mn1+"/"+yr1+"/"+dt2+"/"+mn2+"/"+yr2+"/"+$("#userbranches").val()+"/"+0,"_blank");
			}
		});
		$("#salesviewperiodicticketreport").click(function(){
			if($("#salesperiodicticketreport1").val().trim()!==""){
				var dat1 = $("#salesperiodicticketreport1").val(),
					sp1 = dat1.split("/"),
					dt1 = sp1[0],mn1 = sp1[1],yr1 = sp1[2];
					mn1 = mn1-0,
					dat2 = $("#salesperiodicticketreport2").val(),
					sp2 = dat2.split("/"),
					dt2 = sp2[0],mn2 = sp2[1],yr2 = sp2[2];
					mn2 = mn2-0;

				window.open("/rpt/shiftreportperiodic/"+dt1+"/"+mn1+"/"+yr1+"/"+dt2+"/"+mn2+"/"+yr2+"/"+$("#userbranches").val()+"/"+0,"_blank");
			}
		});

		$("#viewshiftticketreport").click(function(){
			if($("#shiftticketreport1").val().trim()!==""){
				var dat1 = $("#shiftticketreport1").val(),
					sp1 = dat1.split("/"),
					dt1 = sp1[0],mn1 = sp1[1],yr1 = sp1[2];
					mn1 = mn1-0,
					dat2 = $("#shiftticketreport2").val(),
					sp2 = dat2.split("/"),
					dt2 = sp2[0],mn2 = sp2[1],yr2 = sp2[2];
					mn2 = mn2-0;
				window.open("/rpt/complaintpershift/"+yr1+"-"+mn1+"-"+dt1+"/"+yr2+"-"+mn2+"-"+dt2,"_blank");
			}
		});
		
		$("#viewperiodiccategorycomplainreport").click(function(){
			if($("#periodiccategorycomplainreport1").val().trim()!==""){
				var dat1 = $("#periodiccategorycomplainreport1").val(),
					sp1 = dat1.split("/"),
					dt1 = sp1[0],mn1 = sp1[1],yr1 = sp1[2];
					mn1 = mn1-0,
					dat2 = $("#periodiccategorycomplainreport2").val(),
					sp2 = dat2.split("/"),
					dt2 = sp2[0],mn2 = sp2[1],yr2 = sp2[2];
					mn2 = mn2-0;

				window.open("/rpt/categorycomplainreportperiodic/"+dt1+"/"+mn1+"/"+yr1+"/"+dt2+"/"+mn2+"/"+yr2+"/"+$("#userbranches").val(),"_blank");
			}			
		});
		$("#salesdailyticket").click(function(){
			var dat1 = $("#salesfilterdailyticket").val(),
					sp1 = dat1.split("/"),
					dt = sp1[0],mn = sp1[1],yr = sp1[2];
					mn = mn-0;
			window.open("/rpt/shiftreport/"+dt+"/"+mn+"/"+yr+"/"+$("#userbranches").val(),"_blank");
		});
		$('#viewmainrootcausereport').click(function(){
			var dat1 = $("#periodicmainroot1").val(),
					sp1 = dat1.split("/"),
					dt1 = sp1[0],mn1 = sp1[1],yr1 = sp1[2];
					mn1 = mn1-0,
					dat2 = $("#periodicmainroot2").val(),
					sp2 = dat2.split("/"),
					dt2 = sp2[0],mn2 = sp2[1],yr2 = sp2[2];
					mn2 = mn2-0;
			window.open("/rpt/mainrootcause/"+dt1+"/"+mn1+"/"+yr1+"/"+dt2+"/"+mn2+"/"+yr2+"/"+$("#userbranches").val()+"/3-8","_blank");
		});
		$('#viewtop5mainrootcause').click(function(){
			var dat1 = $("#periodtop51").val(),
					sp1 = dat1.split("/"),
					dt1 = sp1[0],mn1 = sp1[1],yr1 = sp1[2];
					mn1 = mn1-0,
					dat2 = $("#periodtop52").val(),
					sp2 = dat2.split("/"),
					dt2 = sp2[0],mn2 = sp2[1],yr2 = sp2[2];
					mn2 = mn2-0;
			window.open("/rpt/periodtop5/"+dt1+"/"+mn1+"/"+yr1+"/"+dt2+"/"+mn2+"/"+yr2+"/"+$("#userbranches").val()+"/3-8","_blank");
		});
		$('#viewtop5subrootcause').click(function(){
			var dat1 = $("#periodtopsub51").val(),
					sp1 = dat1.split("/"),
					dt1 = sp1[0],mn1 = sp1[1],yr1 = sp1[2];
					mn1 = mn1-0,
					dat2 = $("#periodtopsub52").val(),
					sp2 = dat2.split("/"),
					dt2 = sp2[0],mn2 = sp2[1],yr2 = sp2[2];
					mn2 = mn2-0;
			window.open("/rpt/periodtopsub5/"+dt1+"/"+mn1+"/"+yr1+"/"+dt2+"/"+mn2+"/"+yr2+"/"+$("#userbranches").val()+"/1","_blank");
		});
		$('#viewmonthlyduration').click(function(){
			console.log('montyduration invoked');
			window.open("/rpt/viewmonthlyduration/"+$("#monthlydurationyear").val()+"-"+$("#monthlydurationmonth").val());
		});
	</script>
</body>
</html>
