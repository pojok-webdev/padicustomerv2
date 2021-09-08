<script type='text/javascript' src="/js/aquarius/menu.js"></script>
<div class="menu padimenu">
	<div class="breadLine">
		<div class="arrow"></div>
		<div class="adminControl active">
			Hi, <?php
			$myuser = $this->ion_auth->user()->row();
			echo $myuser->username;
			echo " [" . $this->session->userdata["role"] . "] <span class='icon-asterisk' id='changeRole'></span>";
			?>
		</div>
	</div>
	<div class="admin">
		<div class="image">
			<img id="userimage" src="<?php echo $myuser->pic;?>" class="img-polaroid" width=32 height=32/>
		</div>
		<ul class="control">
			<li>
				<span class="icon-comment"></span> <a href="/adm/messages">Messages</a> 
				<a href="/adm/messages" class="caption red notification">0</a>
			</li>
			<li><span class="icon-cog"></span> <a href="/adm/settings">Settings</a></li>
			<li>
				<span class="icon-share-alt"></span> 
					<a href="/adm/logout">
						Logout
					</a>
			</li>
		</ul>
		<div class="info">
			<span id='lastvisit'>Your last visit: <?php echo $this->app_log->get_lastvisit($this->session->userdata['username']);?></span>
		</div>
	</div>
	<ul class="navigation">
		<?php if($this->session->userdata["role"]==="Administrator"){?>
			<li>
				<a href="/dashboards">
					<span class="isw-grid"></span><span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="/dashboards/settings">
					<span class="isw-grid"></span><span class="text">Settings</span>
				</a>
			</li>
		<?php }?>
		<?php
		if($this->session->userdata["role"]==="Administrator"){?>
			<li>
				<a href="/users">
					<span class="isw-users"></span><span class="text">Users</span>
				</a>
			</li>
			<li>
				<a href="/reminders">
					<span class="isw-users"></span><span class="text"  id="reminder">Reminders</span>
				</a>
			</li>
		<?php }?>
		<?php if(($this->session->userdata["role"]==="TS")||($this->session->userdata["role"]==="EOS")||($this->session->userdata["role"]==="Sales")||($this->session->userdata["role"]==="CRO")){?>
			<li class="<?php echo $this->common->getMenuStatus($menuFeed,array('reportfilter'));?>">
				<a href="/rpt/">
					<span class="isw-text_document"></span><span class="text">Laporan</span>
				</a>
			</li>
			<li class="<?php echo $this->common->getMenuStatus($menuFeed,array('schedules'));?>">
				<a href="/schedules/show">
					<span class="isw-schedule"></span><span class="text">Jadwal</span>
				</a>
			</li>
		<?php }?>
		<?php if(($this->session->userdata["role"]=="Sales")||($this->session->userdata["role"]==="CRO")){?>
			<li class="<?php echo $this->common->getMenuStatus($menuFeed,array('suspect'));?>">
				<a href="/suspects">
					<span class="isw-grid"></span><span class="text">Leads</span>
				</a>
			</li>
			<li class="<?php echo $this->common->getMenuStatus($menuFeed,array('prospect'));?>">
				<a href="/prospects">
					<span class="isw-grid"></span><span class="text">Prospek</span>
				</a>
			</li>
		<?php }?>
		<?php if(($this->session->userdata["role"]==="TS")||($this->session->userdata["role"]==="Sales")||($this->session->userdata["role"]==="CRO")){?>
			<li class="<?php echo $this->common->getMenuStatus($menuFeed,array('survey'));?>">
				<a href="/surveys">
					<span class="isw-survey"></span><span class="text">Survey</span>
				</a>
			</li>
		<?php }?>
		<?php if(($this->session->userdata["role"]==="TS")||($this->session->userdata["role"]==="Sales")||($this->session->userdata["role"]==="CRO")){?>
			<li class="<?php echo $this->common->getMenuStatus($menuFeed,array('install'));?>">
				<a href="/install_requests/index/all">
					<span class="isw-install"></span><span class="text">Instalasi</span>
				</a>
			</li>
		<?php }?>
		<?php if(($this->session->userdata["role"]==="Sales")||($this->session->userdata["role"]==="CRO")){?>
			<li class="<?php echo $this->common->getMenuStatus($menuFeed,array('subscribeform'));?>">
				<a href="/subscribeforms">
					<span class="isw-fb"></span><span class="text">Form Berlangganan</span>
				</a>
			</li>
		<?php }?>
		<?php if(($this->session->userdata["role"]==="TS")||($this->session->userdata["role"]==="Sales")){?>
			<li class="<?php echo $this->common->getMenuStatus($menuFeed,array('trials'));?>">
				<a href="/ptrials">
					<span class="isw-grid"></span><span class="text">Trial</span>
				</a>
			</li>
		<?php }?>
		<?php if(($this->session->userdata["role"]==="TS")||($this->session->userdata["role"]==="Sales")){?>
			<li class="<?php echo $this->common->getMenuStatus($menuFeed,array('altergrade'));?>">
				<a href="/altergrades">
					<span class="isw-grid"></span><span class="text">Perubahan Layanan</span>
				</a>
			</li>
		<?php }?>
		<?php if(($this->session->userdata["role"]==="TS")||($this->session->userdata["role"]==="Sales")||($this->session->userdata["role"]==="EOS")||($this->session->userdata["role"]==="CRO")){?>
			<li class="<?php echo $this->common->getMenuStatus($menuFeed,array('maintenance'));?>">
				<a href="/pmaintenanceschedules">
					<span class="isw-grid"></span><span class="text">Maintenance Schedule</span>
				</a>
			</li>
		<?php }?>
		<?php if(($this->session->userdata["role"]==="TS")||($this->session->userdata["role"]==="Sales")||($this->session->userdata["role"]==="CRO")){?>
			<li class="<?php echo $this->common->getMenuStatus($menuFeed,array('maintenancereport'));?>">
				<a href="/maintenancereports">
					<span class="isw-grid"></span><span class="text">Maintenance Report</span>
				</a>
			</li>
		<?php }?>
		<?php if(($this->session->userdata["role"]==="EOS")){?>
			<li class="<?php echo $this->common->getMenuStatus($menuFeed,array('maintenancereport'));?>">
				<a href="/maintenancereports">
					<span class="isw-grid"></span><span class="text">Maintenance Report</span>
				</a>
			</li>
		<?php }?>
		<?php if(($this->session->userdata["role"]=="TS")||($this->session->userdata["role"]=="CRO"||($this->session->userdata["role"]=="Sales")||($this->session->userdata["role"]==="EOS"))){?>
			<li class="<?php echo $this->common->getMenuStatus($menuFeed,array('troubleshoot'));?>">
				<a href="/troubleshoots">
					<span class="isw-wrench"></span><span class="text">Troubleshoot</span>
				</a>
			</li>
		<?php }?>
		<?php if(($this->session->userdata["role"]==="TS")||($this->session->userdata["role"]==="Sales")||($this->session->userdata["role"]==="Accounting")){?>
			<li class="<?php echo $this->common->getMenuStatus($menuFeed,array('disconnection'));?>">
				<a href="/disconnections/index/0">
					<span class="isw-broken"></span><span class="text">Disconnection</span>
				</a>
			</li>
		<?php }?>

        <?php if(($this->session->userdata["role"]=="Sales")||($this->session->userdata["role"]==="CRO")){?>
			<li class="<?php echo $this->common->getMenuStatus($menuFeed,array('pricelistproduct'));?>">
				<a href="/pricelistproducts">
					<span class="isw-grid"></span><span class="text">Price List Products</span>
				</a>
			</li>
			<li class="<?php echo $this->common->getMenuStatus($menuFeed,array('pricelistsnote'));?>">
				<a href="/pricelistnotes">
					<span class="isw-grid"></span><span class="text">Price List Notes</span>
				</a>
			</li>
		<?php }?>
		<?php if(($this->session->userdata["role"]==="TS")||($this->session->userdata["role"]=="CRO")||($this->session->userdata["role"]=="Sales")||($this->session->userdata["role"]==="EOS")){?>
			<li class="<?php echo $this->common->getMenuStatus($menuFeed,array('ticket'));?>">
				<a href="/tickets">
					<span class="isw-ticket"></span><span class="text">Tiket</span>
				</a>
			</li>
		<?php }?>
		<?php if(padi_inrole(array('sm-farmer','farmer','ts','field'))){?>
		<li class="openable <?php echo $this->common->getMenuStatus($menuFeed,array('client','clientSite'));?>">
			<a href="/clients">
				<span class="isw-clients"></span><span class="text">History Pelanggan</span>
				<ul>
					<li class="<?php echo $this->common->getMenuStatus($menuFeed,array('clientSite'));?>">
						<a href="/clients">
						<span class="icon-th"></span><span class="text">History Pelanggan</span>
						</a>
					</li>
					<li class="<?php echo $this->common->getMenuStatus($menuFeed,array('clientSite'));?>">
						<a href="/pclientgroups">
						<span class="icon-th"></span><span class="text">Grup Pelanggan</span>
						</a>
					</li>
				</ul>
			</a>
		</li>
		<?php }?>
		<?php if(($this->session->userdata["role"]==="CRO")){?>
		<li class=" <?php echo $this->common->getMenuStatus($menuFeed,array('biodata'));?>">
			<a href="/pbiodata">
				<span class="isw-grid"></span><span class="text">Biodata Pelanggan</span>
			</a>
		</li>
		<?php }?>
		<?php if(($this->session->userdata["role"]==="Administrator")){?>
		<li class="<?php echo $this->common->getMenuStatus($menuFeed,array('report'));?>">
			<a href="/paqs">
				<span class="isw-grid"></span><span class="text">PAQs</span>
			</a>
		</li>
		<?php }?>
		<?php if(($this->session->userdata["role"]==="Umum dan Warehouse")||($this->session->userdata["role"]==="TS")){?>
		<li class="openable <?php echo $this->common->getMenuStatus($menuFeed,array('devicetype','device','materialtype','material','backbone','bts','ap','surveypackage'));?>">
			<a href="/adm/troubleshoots">
				<span class="isw-table"></span><span class="text">Master</span>
			<ul>
				<?php if(($this->session->userdata["role"]==="Umum dan Warehouse")){?>
				<li>
					<a href="/adm/devicetypes">
						<span class="icon-th"></span><span class="text">Jenis Peralatan</span>
					</a>
				</li>
				<?php }?>
				<?php if(($this->session->userdata["role"]==="Umum dan Warehouse")){?>
				<li>
					<a href="/adm/devices">
						<span class="icon-th"></span><span class="text">Daftar Peralatan</span>
					</a>
				</li>
				<?php }?>
				<?php if(($this->session->userdata["role"]==="Umum dan Warehouse")){?>
				<li>
					<a href="/adm/materialtypes">
						<span class="icon-th"></span><span class="text">Jenis Material</span>
					</a>
				</li>
				<?php }?>
				<?php if(($this->session->userdata["role"]==="Umum dan Warehouse")){?>
				<li>
					<a href="/adm/materials">
						<span class="icon-th"></span><span class="text">Daftar Material</span>
					</a>
				</li>
				<?php }?>
				<?php if(($this->session->userdata["role"]==="TS")){?>
				<li>
					<a href="/adm/backbones">
						<span class="icon-th"></span><span class="text">Backbones</span>
					</a>
				</li>
				<?php }?>
				<?php if(($this->session->userdata["role"]==="TS")){?>
				<li>
					<a href="/datacenters">
						<span class="icon-th"></span><span class="text">Data Centers</span>
					</a>
				</li>
				<?php }?>
				<?php if(($this->session->userdata["role"]==="TS")){?>
				<li>
					<a href="/pbtses">
						<span class="icon-th"></span><span class="text">BTS</span>
					</a>
				</li>
				<?php }?>
				<?php if(($this->session->userdata["role"]==="TS")){?>
				<li>
					<a href="/adm/aps">
						<span class="icon-th"></span><span class="text">AP</span>
					</a>
				</li>
				<?php }?>
				<?php if(($this->session->userdata["role"]==="TS")){?>
				<li>
					<a href="/ptps/ptps">
						<span class="icon-th"></span><span class="text">PTP</span>
					</a>
				</li>
				<?php }?>
				<?php if(($this->session->userdata["role"]==="TS")){?>
				<li>
					<a href="/cores/cores">
						<span class="icon-th"></span><span class="text">Cores</span>
					</a>
				</li>
				<?php }?>
				<?php if(($this->session->userdata["role"]==="TS")){?>
				<li>
					<a href="/pservers">
						<span class="icon-th"></span><span class="text">Servers</span>
					</a>
				</li>
				<?php }?>
				<?php if($this->session->userdata["role"]==="Umum dan Warehouse"){?>
				<li>
					<a href="/surveypackages/">
						<span class="icon-th"></span><span class="text">Paket Perangkat Survey</span>
					</a>
				</li>
				<?php }?>
			</ul>
			</a>
		</li>
		<?php }?>
	</ul>
</div>
