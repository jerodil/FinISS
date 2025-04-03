$(document).ready(function(){
	$error = $('<center><label class = "text-danger">Please Fill up the form!</label></center>');
	$error1 = $('<center><label class = "text-danger">Invalid username or password</label></center>');
	$loading = $('<center><img src = "images/loading.gif"></center>');
	$load_status= $('<center><label class = "text-success">Waiting...</label></center>');
	$valid = $('<center><label class = "text-danger">Name already taken!</label></center>');
	$mem_valid = $('<center><label class = "text-danger">Member name already exist!</label></center>');
	$club_valid = $('<center><label class = "text-danger">Program name already exist!</label></center>');
	$group_valid = $('<center><label class = "text-danger">Member already joined!</label></center>');
	
// Administrator Login	
	$('#login').click(function(){
		$error.remove();
		$error1.remove();
		$username  = $('#username').val();
		$password = $('#password').val();
		if($username == "" && $password == ""){
			$error.appendTo('#loading');
		}else{
			$loading.appendTo('#loading');
			setTimeout(function(){
				$.post('validate.php', {username: $username, password: $password},
					function(result){
						if(result == "Success"){
							window.location = 'home.php';
							$('#username').val('');
							$('#password').val('');
							$loading.remove();
						}else{
							$error1.appendTo('#loading');
							$('#username').val('');
							$('#password').val('');
							$loading.remove();
						}
					}
				)	
			}, 3000);	
		}
	});
	
//Administrator Registration	
	$('#signup').click(function(){
		$error.remove();
		$valid.remove();
		$username = $('#username').val();
		$password = $('#password').val();
		if($username == "" || $password == ""){
			$error.appendTo('#loading');
		}else{
			$load_status.appendTo('#loading');
			setTimeout(function(){
				$.post('valid_signup.php', {username: $username},
					function(result){
						if(result == "Success"){
							$valid.appendTo('#loading');
						}else{
							$.ajax({
								type: 'POST',
								url: 'save_data.php',
								data: {username: $username, password: $password},
								success: function(){
									window.location = 'account.php';
								}
							});
						}
					}
				)
				$load_status.remove();
			}, 3000)
		}
	});
//Administrator Edit
	$('#acc_edit').click(function(){
		$admin_id = $('#admin_id').val();
		$error.remove();
		$valid.remove();
		$username = $('#username').val();
		$password = $('#password').val();
		if($username == "" || $password == ""){
			$error.appendTo('#loading');
		}else{
			$load_status.appendTo('#loading');
			setTimeout(function(){
				$.post('valid_signup.php', {username: $username},
					function(result){
						if(result == "Success"){
							$valid.appendTo('#loading');
						}else{
							$.ajax({
								type: 'POST',
								url: 'account_edit_query.php?admin_id=' + $admin_id,
								data: {username: $username, password: $password},
								success: function(){
									window.location = 'account.php';
								}
							});
						}
					}
				)
				$load_status.remove();
			}, 3000)
		}
	});
// Member Registration
	$('#save_member').click(function(){
		$error.remove();
		$mem_valid.remove();
		//bene
		$lastname = $('#lastname').val();
		$firstname = $('#firstname').val();
		$middlename = $('#middlename').val();
		$ext = $('#ext').val();
		$st = $('#st').val();
		$bgy = $('#bgy').val();
		$city = $('#myModal #city').val();
		$province = $('#myModal #province').val();
		$region = $('#myModal #region').val();
		$cp = $('#cp').val();
		$bdate = $('#bdate').val();
		$age = $('#age').val();
		$sex = $('#myModal #sex').val();
		$work = $('#work').val();
		$kita = $('#kita').val();
		//representative
		$rep_lname = $('#rep_lname').val();
		$rep_fname = $('#rep_fname').val();
		$rep_mname = $('#rep_mname').val();
		$rep_ext = $('#rep_ext').val();
		$rep_st = $('#rep_st').val();
		$rep_bgy = $('#rep_bgy').val();
		$rep_city = $('#myModal #rep_city').val();
		$rep_prov = $('#myModal #rep_prov').val();
		$rep_region = $('#myModal #rep_region').val();
		$rep_cp = $('#rep_cp').val();
		$rep_bdate = $('#rep_bdate').val();
		$rep_rel_bene = $('#myModal #rep_rel_bene').val();
		$rep_rel = $('#rep_rel').val();
		//type of assistance
		$type_of_assistance = $('#myModal #type_of_assistance').val();
		$toa_med = $('#myModal #toa_med').val();
		$toa_fun = $('#myModal #toa_fun').val();
		if($firstname == "" || $middlename == "" || $lastname == ""){
			$error.appendTo('#loading');
		}else{
			$load_status.appendTo('#loading');
			setTimeout(function(){
				$.post('mem_validator.php', {firstname: $firstname, middlename: $middlename, lastname: $lastname},
					function(result){
						if(result == "Success"){
							
							$mem_valid.appendTo('#loading');
							
						}else{
							$.ajax({
								type: 'POST',
								url: 'save_member.php',
								data: {lastname: $lastname, firstname: $firstname, middlename: $middlename, 
								ext: $ext, st: $st, bgy: $bgy, city: $city, province: $province, region: $region,
								cp: $cp, bdate: $bdate, age: $age, sex: $sex, work: $work, kita: $kita,
								rep_lname: $rep_lname, rep_fname: $rep_fname, rep_mname: $rep_mname,
								rep_ext: $rep_ext, rep_st: $rep_st, rep_bgy: $rep_bgy, rep_city: $rep_city, rep_prov: $rep_prov,
								rep_region: $rep_region, rep_cp: $rep_cp, rep_bdate: $rep_bdate, rep_rel_bene: $rep_rel_bene,
								rep_rel: $rep_rel, type_of_assistance: $type_of_assistance, toa_med: $toa_med, toa_fun: $toa_fun
								},
								success: function(){
									window.location = 'member.php';
								}
							});
						}
					}
				)
			$load_status.remove();	
			}, 3000)
		}
	});
// Member Edit
$('#mem_edit').click(function(){
		$error.remove();
		$mem_id = $('#mem_id').val();
		$mem_valid.remove();
		$lastname = $('#lastname').val();
		$firstname = $('#firstname').val();
		$middlename = $('#middlename').val();
		$ext = $('#ext').val();
		$st = $('#st').val();
		$bgy = $('#bgy').val();
		$city = $('#city').val();
		$province = $('#province').val();
		$region = $('#region').val();
		$cp = $('#cp').val();
		$bdate = $('#bdate').val();
		$age = $('#age').val();
		$sex = $('#sex').val();
		$work = $('#work').val();
		$kita = $('#kita').val();
		
		$rep_lname = $('#rep_lname').val();
		$rep_fname = $('#rep_fname').val();
		$rep_mname = $('#rep_mname').val();
		$rep_ext = $('#rep_ext').val();
		$rep_st = $('#rep_st').val();
		$rep_bgy = $('#rep_bgy').val();
		$rep_city = $('#rep_city').val();
		$rep_prov = $('#rep_prov').val();
		$rep_region = $('#rep_region').val();
		$rep_cp = $('#rep_cp').val();
		$rep_bdate = $('#rep_bdate').val();
		$rep_rel_bene = $('#rep_rel_bene').val();
		$rep_rel = $('#rep_rel').val();
		
		$type_of_assistance = $('#type_of_assistance').val();
		$toa_med = $('#toa_med').val();
		$toa_fun = $('#toa_fun').val();
		if($firstname == "" || $middlename == "" || $lastname == ""){
			$error.appendTo('#loading');
		}else{
			$load_status.appendTo('#loading');
			setTimeout(function(){
				$.post('mem_validator.php', {firstname: $firstname, middlename: $middlename, lastname: $lastname},
					function(result){
						if(result == "Success"){
							$mem_valid.appendTo('#loading');
						}else{
							$.ajax({
								type: 'POST',
								url: 'mem_edit_query.php?mem_id=' + $mem_id,
								data: {lastname: $lastname, firstname: $firstname, middlename: $middlename, 
									ext: $ext, st: $st, bgy: $bgy, city: $city, province: $province, region: $region,
									cp: $cp, bdate: $bdate, age: $age, sex: $sex, work: $work, kita: $kita,
									rep_lname: $rep_lname, rep_fname: $rep_fname, rep_mname: $rep_mname,
									rep_ext: $rep_ext, rep_st: $rep_st, rep_bgy: $rep_bgy, rep_city: $rep_city, rep_prov: $rep_prov,
									rep_region: $rep_region, rep_cp: $rep_cp, rep_bdate: $rep_bdate, rep_rel_bene: $rep_rel_bene,
									rep_rel: $rep_rel, type_of_assistance: $type_of_assistance, toa_med: $toa_med, toa_fun: $toa_fun
								},
								success: function(){
									window.location = 'member.php';
								}
							});
						}
					}
				)
			$load_status.remove();	
			}, 3000)
		}
	});
// Club Registration
$('#save_club').click(function(){
		$error.remove();
		$club_valid.remove();
		$club = $('#club').val();
		if($club == "" ){
			$error.appendTo('#loading');
		}else{
			$load_status.appendTo('#loading');
			setTimeout(function(){
				$.post('club_validator.php', {club: $club},
					function(result){
						if(result == "Success"){
							$club_valid.appendTo('#loading');
						}else{
							$.ajax({
								type: 'POST',
								url: 'save_club.php',
								data: {club: $club},
								success: function(){
									window.location = 'club.php';
								}
							});
						}
					}
				)
			$load_status.remove();	
			}, 3000)
		}
	});
// Club Edit
$('#club_edit').click(function(){
		$error.remove();
		$club_id = $('#club_id').val();
		$club_valid.remove();
		$club = $('#club').val();
		if($club == ""){
			$error.appendTo('#loading');
		}else{
			$load_status.appendTo('#loading');
			setTimeout(function(){
				$.post('club_validator.php', {club: $club},
					function(result){
						if(result == "Success"){
							$club_valid.appendTo('#loading');
						}else{
							$.ajax({
								type: 'POST',
								url: 'club_edit_query.php?club_id=' + $club_id,
								data: {club: $club},
								success: function(){
									window.location = 'club.php';
								}
							});
						}
					}
				)
			$load_status.remove();	
			}, 3000)
		}
	});
	$('#save_group').click(function(){
		$error.remove();
		$group_valid.remove();
		$mem_id = $('#member').val();
		$club_id = $('#club').val();
		if($mem_id == "" ){
			$error.appendTo('#loading');
		}else{
			$load_status.appendTo('#loading');
			setTimeout(function(){
				$.post('group_validator.php', {mem_id: $mem_id, club_id: $club_id},
					function(result){
						if(result == "Success"){
							$group_valid.appendTo('#loading');
						}else{
							$.ajax({
								type: 'POST',
								url: 'save_group.php',
								data: {mem_id: $mem_id, club_id: $club_id},
								success: function(){
									window.location = 'group.php?club_id=' + $club_id;
								}
							});
						}
					}
				)
			$load_status.remove();	
			}, 3000)
		}
	});
	//assess member
	$('#save_assess').click(function(){
		$error.remove();
		$mem_valid.remove();
		//category
		$bene_cat = $('#bene_cat').val();
		$bene_sub_cat = $('#bene_sub_cat').val();
		$other_cat = $('#other_cat').val();
		$assess = $('#assess').val();
		//mem1 fam
		$mem1_fname = $('#mem1_fname').val();
		$mem1_mname = $('#mem1_mname').val();
		$mem1_lname = $('#mem1_lname').val();
		$mem1_ext = $('#mem1_ext').val();
		$mem1_rel_bene = $('#mem1_rel_bene').val();
		$mem1_age = $('#mem1_age').val();
		$mem1_work = $('#mem1_work').val();
		$mem1_kita = $('#mem1_kita').val();
		//mem2 fam
		$mem2_fname = $('#mem2_fname').val();
		$mem2_mname = $('#mem2_mname').val();
		$mem2_lname = $('#mem2_lname').val();
		$mem2_ext = $('#mem2_ext').val();
		$mem2_rel_bene = $('#mem2_rel_bene').val();
		$mem2_age = $('#mem2_age').val();
		$mem2_work = $('#mem2_work').val();
		$mem2_kita = $('#mem2_kita').val();
		//mem3 fam
		$mem3_fname = $('#mem3_fname').val();
		$mem3_mname = $('#mem3_mname').val();
		$mem3_lname = $('#mem3_lname').val();
		$mem3_ext = $('#mem3_ext').val();
		$mem3_rel_bene = $('#mem3_rel_bene').val();
		$mem3_age = $('#mem3_age').val();
		$mem3_work = $('#mem3_work').val();
		$mem3_kita = $('#mem3_kita').val();
		//type of assistance
		$toa = $('#toa').val();
		$toa_medical = $('#toa_medical').val();
		$toa_funeral = $('#toa_funeral').val();
		$toa_financial = $('#toa_financial').val();
		$toa_material = $('#toa_material').val();
		$pur = $('#pur').val();
		$amount = $('#amount').val();
		$moa = $('#moa').val();
		$fund_source = $('#fund_source').val();
		$social_worker = $('#social_worker').val();
		$ciu_head = $('#ciu_head').val();

		$param = new URLSearchParams(window.location.search);
		$ce_id = $param.get('ce_id');
		
		if($mem1_fname == "" || $mem1_mname == "" || $mem1_lname == ""){
			$error.appendTo('#loading');
		}else{
			$load_status.appendTo('#loading');
			setTimeout(function(){
				$.post('mem_asseess_validator.php', {mem1_fname: $mem1_fname, mem1_mname: $mem1_mname, mem1_lname: $mem1_lname},
					function(result){
						if(result == "Success"){
							
							$mem_valid.appendTo('#loading');
							
						}else{
							$.ajax({
								type: 'POST',
								url: 'assess_member_query.php',
								data: {bene_cat: $bene_cat, bene_sub_cat: $bene_sub_cat, other_cat: $other_cat, 
								assess: $assess, mem1_fname: $mem1_fname, mem1_mname: $mem1_mname, mem1_lname: $mem1_lname, mem1_ext: $mem1_ext, mem1_rel_bene: $mem1_rel_bene,
								mem1_age: $mem1_age, mem1_work: $mem1_work, mem1_kita: $mem1_kita, mem2_fname: $mem2_fname, mem2_mname: $mem2_mname, mem2_lname: $mem2_lname,
								mem2_ext: $mem2_ext, mem2_rel_bene: $mem2_rel_bene, mem2_age: $mem2_age, mem2_work: $mem2_work, mem2_kita: $mem2_kita,
								mem3_fname: $mem3_fname, mem3_mname: $mem3_mname, mem3_lname: $mem3_lname, mem3_ext: $mem3_ext, mem3_rel_bene: $mem3_rel_bene, mem3_age: $mem3_age,
								mem3_work: $mem3_work, mem3_kita: $mem3_kita, toa: $toa, toa_medical: $toa_medical, toa_funeral: $toa_funeral, toa_financial: $toa_financial,
								toa_material: $toa_material, pur: $pur, amount: $amount, moa: $moa, fund_source: $fund_source,
								social_worker: $social_worker, ciu_head: $ciu_head, ce_id: $ce_id
								},
								success: function(){
									window.location = 'benelist.php';
								}
							});
						}
					}
				)
			$load_status.remove();	
			}, 3000)
		}
	});
	//SDO Registration	
	$('#add_sdo').click(function(){
		$error.remove();
		$valid.remove();
		$sdo_fname = $('#sdo_fname').val();
		$sdo_mname = $('#sdo_mname').val();
		$sdo_lname = $('#sdo_lname').val();
		$sdo_ext = $('#sdo_ext').val();
		$sdo_emp_id = $('#sdo_emp_id').val();
		$sdo_office = $('#sdo_office').val();
		$sdo_unit = $('#sdo_unit').val();
		$sdo_pos = $('#sdo_pos').val();
		$sdo_emp_status = $('#sdo_emp_status').val();
		$sdo_amount = $('#sdo_amount').val();
		$year_sdo = $('#myModal #year_sdo').val();
		$cp = $('#cp').val();
		
		$ors = [];
		$dv = [];
		$rso = [];
		$rso_ben = [];
		$conca = [];
		$fb = [];

		$('.form-check-input').each(function() {
			if ($(this).is(":checked")) {
				$ors.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$dv.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$rso.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$rso_ben.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$conca.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$fb.push($(this).val());
			}
		});
		$ors = $ors.toString();  // toString function convert array to string
		$dv = $dv.toString();  // toString function convert array to string
		$rso = $rso.toString();  // toString function convert array to string
		$rso_ben = $rso_ben.toString();  // toString function convert array to string
		$conca = $conca.toString();  // toString function convert array to string
		$fb = $fb.toString();  // toString function convert array to string

		if($sdo_fname == "" || $sdo_lname == ""){
			$error.appendTo('#loading');
		}else{
			$load_status.appendTo('#loading');
			setTimeout(function(){
				$.post('valid_sdo.php', {sdo_fname: $sdo_fname},
					function(result){
						if(result == "Success"){
							$valid.appendTo('#loading');
						}else{
							$.ajax({
								type: 'POST',
								url: 'sdo_query.php',
								data: {sdo_fname: $sdo_fname, sdo_mname: $sdo_mname, sdo_lname: $sdo_lname, sdo_ext: $sdo_ext, sdo_emp_id: $sdo_emp_id, sdo_office: $sdo_office, 
									sdo_unit: $sdo_unit, sdo_pos: $sdo_pos, sdo_emp_status: $sdo_emp_status, sdo_amount: $sdo_amount, year_sdo: $year_sdo, cp: $cp, ors: $ors, dv: $dv, 
									rso: $rso, rso_ben: $rso_ben, conca: $conca, fb: $fb},
								success: function(){
									window.location = 'cheque_add.php';
								}
							});
						}
					}
				)
				$load_status.remove();
			}, 3000)
		}
	});
	//SDO Edit
	$('#sdo_edit').click(function(){
		$error.remove();
		$sdo_id = $('#sdo_id').val();
		$valid.remove();
		$sdo_fname = $('#sdo_fname').val();
		$sdo_mname = $('#sdo_mname').val();
		$sdo_lname = $('#sdo_lname').val();
		$sdo_ext = $('#sdo_ext').val();
		$sdo_emp_id = $('#sdo_emp_id').val();
		$sdo_office = $('#sdo_office').val();
		$sdo_unit = $('#sdo_unit').val();
		$sdo_pos = $('#sdo_pos').val();
		$sdo_emp_status = $('#sdo_emp_status').val();
		$sdo_amount = $('#sdo_amount').val();
		$year_sdo = $('#year_sdo').val();
		$cp = $('#cp').val();

		$ors = [];
		$dv = [];
		$rso = [];
		$rso_ben = [];
		$conca = [];
		$fb = [];

		$('.form-check-input').each(function() {
			if ($(this).is(":checked")) {
				$ors.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$dv.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$rso.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$rso_ben.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$conca.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$fb.push($(this).val());
			}
		});
		$ors = $ors.toString();  // toString function convert array to string
		$dv = $dv.toString();  // toString function convert array to string
		$rso = $rso.toString();  // toString function convert array to string
		$rso_ben = $rso_ben.toString();  // toString function convert array to string
		$conca = $conca.toString();  // toString function convert array to string
		$fb = $fb.toString();  // toString function convert array to string
		if($sdo_fname == ""){
			$error.appendTo('#loading');
		}else{
			$load_status.appendTo('#loading');
			setTimeout(function(){
				$.post('valid_sdo.php', {sdo_fname: $sdo_fname},
					function(result){
						if(result == "Success"){
							$valid.appendTo('#loading');
						}else{
							$.ajax({
								type: 'POST',
								url: 'sdo_edit_query.php?sdo_id=' + $sdo_id,
								data: {sdo_fname: $sdo_fname, sdo_mname: $sdo_mname, sdo_lname: $sdo_lname, sdo_ext: $sdo_ext, sdo_emp_id: $sdo_emp_id, sdo_office: $sdo_office, sdo_unit: $sdo_unit,
									sdo_pos: $sdo_pos, sdo_emp_status: $sdo_emp_status, sdo_amount: $sdo_amount, year_sdo: $year_sdo, cp: $cp, ors: $ors, dv: $dv, 
									rso: $rso, rso_ben: $rso_ben, conca: $conca, fb: $fb
								},
								success: function(){
									window.location = 'sdo.php';
								}
							});
						}
					}
				)
			$load_status.remove();	
			}, 3000)
		}
	});
	//Cheque_add	
	$('#add_sdo_cheque').click(function(){
		$error.remove();
		$valid.remove();
		$sdo_id = $('#sdo_id').val();
		$cheque_no = $('#cheque_no').val();
		$cheque_date = $('#cheque_date').val();
		$ca_id = $('#ca_id').val();
		
		
		if($cheque_no == ""){
			$error.appendTo('#loading');
		}else{
			$load_status.appendTo('#loading');
			setTimeout(function(){
				$.post('valid_sdo_cheque.php', {cheque_no: $cheque_no},
					function(result){
						if(result == "Success"){
							$valid.appendTo('#loading');
						}else{
							$.ajax({
								type: 'POST',
								url: 'cheque_add_query.php',
								data: {sdo_id: $sdo_id, cheque_no: $cheque_no, cheque_date: $cheque_date, ca_id: $ca_id},
								success: function(){
									location.reload();
									//window.location = 'sdo.php';
								}
							});
						}
					}
				)
				$load_status.remove();
			}, 3000)
		}
	});
	//check edit
	$('#check_edit').click(function(){
		$error.remove();
		$cheque_id = $('#cheque_id').val();
		$valid.remove();
		$sdo_id = $('#sdo_id').val();
		$cheque_no = $('#cheque_no').val();
		$cheque_date = $('#cheque_date').val();
		$cheque_amount = $('#cheque_amount').val();
		$ors = $('#ors').val();
		$dv = $('#dv').val();
		$uacs_object = $('#uacs_object').val();
	
		if($cheque_no == ""){
			$error.appendTo('#loading');
		}else{
			$load_status.appendTo('#loading');
			setTimeout(function(){
				$.post('valid_sdo_cheque.php', {cheque_no: $cheque_no},
					function(result){
						if(result == "Success"){
							$valid.appendTo('#loading');
						}else{
							$.ajax({
								type: 'POST',
								url: 'cheque_edit_query.php?cheque_id=' + $cheque_id,
								data: {sdo_id: $sdo_id, cheque_no: $cheque_no, cheque_date: $cheque_date, cheque_amount: $cheque_amount,uacs_object: $uacs_object, ors: $ors, dv: $dv
								},
								success: function(){
									//location.reload();
									window.location.href = 'cheque_add.php';
								}
							});
						}
					}
				)
			$load_status.remove();	
			}, 3000)
		}
	});
	//Save CE
	$("#save_ce").click(function(){
		
		$category = $('#myModal #category').val();
		
		$date_assess = $('#date_assess').val();
		$ben_lname = $('#ben_lname').val();
		$ben_fname = $('#ben_fname').val();
		$ben_mname = $('#ben_mname').val();
		$ben_ext = $('#ben_ext').val();
		$ben_sex = $('#myModal #ben_sex').val();
		$ben_age = $('#ben_age').val();

		$ben_reg = $('#myModal #ben_reg').val();
		$ben_prov = $('#myModal #ben_prov').val();
		$ben_city = $('#myModal #ben_city').val();
		$ben_bgy = $('#ben_bgy').val();
		$ben_st = $('#ben_st').val();
		
		$rep_lname = $('#rep_lname').val();
		$rep_fname = $('#rep_fname').val();
		$rep_mname = $('#rep_mname').val();
		$rep_ext = $('#rep_ext').val();
		$rep_rel_ben = $('#myModal #rep_rel_ben').val();
		$other_rel = $('#other_rel').val();

		$gis = [];
		$pantawid_id = [];
		$just = [];
		$med_cert_abs = [];
		$prescript = [];
		$soa = [];
		$treat_proc = [];
		$quotation = [];
		$dis_sum = [];
		$lab_req = [];
		$charge_slip = [];
		$funeral_cont = [];
		$death_cert = [];
		$det_sum = [];
		$ref_let = [];
		$soc_cas_stud_rep = [];

		$val_id = $('#val_id').val();
		$other_doc = $('#other_doc').val();
		$toa = $('#myModal #toa').val();
		$toa_medical = $('#myModal #toa_medical').val();
		$toa_funeral = $('#myModal #toa_funeral').val();
		$toa_financial = $('#myModal #toa_financial').val();
		$toa_material = $('#myModal #toa_material').val();
		$amount = $('#amount').val();
		$a_year = $('#a_year').val();
		$social_worker = $('#social_worker').val();
		$ciu_head = $('#ciu_head').val();
		$sdo_id = $('#myModal #sdo_id').val();
		$ca_id = $('#myModal #ca_id').val();
		$swo_admin = $('#swo_admin').val();
	
		$('.form-check-input').each(function() {
			if ($(this).is(":checked")) {
				$gis.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$pantawid_id.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$just.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$med_cert_abs.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$prescript.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$soa.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$treat_proc.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$quotation.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$dis_sum.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$lab_req.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$charge_slip.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$funeral_cont.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$death_cert.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$det_sum.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$ref_let.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$soc_cas_stud_rep.push($(this).val());
			}	
				
		});
		$gis = $gis.toString();  // toString function convert array to string
		$pantawid_id = $pantawid_id.toString();  // toString function convert array to string
		$just = $just.toString();  // toString function convert array to string
		$med_cert_abs = $med_cert_abs.toString();  // toString function convert array to string
		$prescript = $prescript.toString();  // toString function convert array to string
		$soa = $soa.toString();  // toString function convert array to string
		$treat_proc = $treat_proc.toString();  // toString function convert array to string
		$quotation = $quotation.toString();  // toString function convert array to string
		$dis_sum = $dis_sum.toString();  // toString function convert array to string
		$lab_req = $lab_req.toString();  // toString function convert array to string
		$charge_slip = $charge_slip.toString();  // toString function convert array to string
		$funeral_cont = $funeral_cont.toString();  // toString function convert array to string
		$death_cert = $death_cert.toString();  // toString function convert array to string
		$det_sum = $det_sum.toString();  // toString function convert array to string
		$ref_let = $ref_let.toString();  // toString function convert array to string
		$soc_cas_stud_rep = $soc_cas_stud_rep.toString();  // toString function convert array to string
		$.ajax({
			url: "benelist_query.php",
			method: "POST",
			data:{ //$(this).serialize()
				category : $category, date_assess: $date_assess, ben_lname: $ben_lname, ben_fname: $ben_fname, ben_mname: $ben_mname, ben_ext: $ben_ext, ben_sex: $ben_sex, ben_age: $ben_age, ben_reg: $ben_reg,
				ben_prov: $ben_prov, ben_city: $ben_city, ben_bgy: $ben_bgy, ben_st: $ben_st, rep_rel_ben: $rep_rel_ben, other_rel: $other_rel, rep_lname: $rep_lname, rep_fname: $rep_fname, rep_mname: $rep_mname,
				rep_ext: $rep_ext, gis: $gis, pantawid_id: $pantawid_id, just: $just, med_cert_abs: $med_cert_abs, prescript: $prescript, soa: $soa, treat_proc: $treat_proc, quotation: $quotation, dis_sum: $dis_sum,
				lab_req: $lab_req, charge_slip: $charge_slip, funeral_cont: $funeral_cont, death_cert: $death_cert, det_sum: $det_sum, ref_let: $ref_let, soc_cas_stud_rep: $soc_cas_stud_rep, val_id: $val_id, other_doc: $other_doc, 
				toa: $toa, toa_medical: $toa_medical, toa_funeral: $toa_funeral, toa_financial: $toa_financial, toa_material: $toa_material, amount: $amount, a_year: $a_year, social_worker: $social_worker, ciu_head: $ciu_head,
				sdo_id: $sdo_id, ca_id: $ca_id, swo_admin: $swo_admin
				
			},
			success: function() {
				// if (result==1) {
                //     $("#formSubmit").trigger("reset");
                //     //alert("Data insert in database successfully");
                // }
				//$('#result').html(data);
				//location.reload();
			}
		});
	});

	//Edit CE
	$("#bene_edit").click(function(){
		$ce_id = $('#ce_id').val();
		$category = $('#cat').val();
		
		$date_assess = $('#date_assess').val();
		$ben_lname = $('#ben_lname').val();
		$ben_fname = $('#ben_fname').val();
		$ben_mname = $('#ben_mname').val();
		$ben_ext = $('#ben_ext').val();
		$ben_sex = $('#sex').val();
		$ben_age = $('#ben_age').val();

		$ben_reg = $('#reg').val();
		$ben_prov = $('#prov').val();
		$ben_city = $('#city').val();
		$ben_bgy = $('#ben_bgy').val();
		$ben_st = $('#ben_st').val();
		
		$rep_lname = $('#rep_lname').val();
		$rep_fname = $('#rep_fname').val();
		$rep_mname = $('#rep_mname').val();
		$rep_ext = $('#rep_ext').val();
		$rep_rel_ben = $('#rel_ben').val();
		$other_rel = $('#other_rel').val();

		$gis = [];
		$pantawid_id = [];
		$just = [];
		$med_cert_abs = [];
		$prescript = [];
		$soa = [];
		$treat_proc = [];
		$quotation = [];
		$dis_sum = [];
		$lab_req = [];
		$charge_slip = [];
		$funeral_cont = [];
		$death_cert = [];
		$det_sum = [];
		$ref_let = [];
		$soc_cas_stud_rep = [];

		$val_id = $('#val_id').val();
		$other_doc = $('#other_doc').val();
		$toa = $('#toa #toa').val();
		$toa_medical = $('#toa_medical #toa_medical').val();
		$toa_funeral = $('#toa_funeral #toa_funeral').val();
		$toa_financial = $('#toa_financial #toa_financial').val();
		$toa_material = $('#toa_material #toa_material').val();
		$amount = $('#amount').val();
		$a_year = $('#a_year').val();
		$social_worker = $('#social_worker').val();
		$ciu_head = $('#ciu_head').val();
		$sdo_id = $('#sdo_id #sdo_id').val();
		
		$swo_admin = $('#swo_admin').val();
	
		$('.form-check-input').each(function() {
			if ($(this).is(":checked")) {
				$gis.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$pantawid_id.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$just.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$med_cert_abs.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$prescript.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$soa.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$treat_proc.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$quotation.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$dis_sum.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$lab_req.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$charge_slip.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$funeral_cont.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$death_cert.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$det_sum.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$ref_let.push($(this).val());
			}
			if ($(this).is(":checked")) {
				$soc_cas_stud_rep.push($(this).val());
			}	
				
		});
		$gis = $gis.toString();  // toString function convert array to string
		$pantawid_id = $pantawid_id.toString();  // toString function convert array to string
		$just = $just.toString();  // toString function convert array to string
		$med_cert_abs = $med_cert_abs.toString();  // toString function convert array to string
		$prescript = $prescript.toString();  // toString function convert array to string
		$soa = $soa.toString();  // toString function convert array to string
		$treat_proc = $treat_proc.toString();  // toString function convert array to string
		$quotation = $quotation.toString();  // toString function convert array to string
		$dis_sum = $dis_sum.toString();  // toString function convert array to string
		$lab_req = $lab_req.toString();  // toString function convert array to string
		$charge_slip = $charge_slip.toString();  // toString function convert array to string
		$funeral_cont = $funeral_cont.toString();  // toString function convert array to string
		$death_cert = $death_cert.toString();  // toString function convert array to string
		$det_sum = $det_sum.toString();  // toString function convert array to string
		$ref_let = $ref_let.toString();  // toString function convert array to string
		$soc_cas_stud_rep = $soc_cas_stud_rep.toString();  // toString function convert array to string
		$.ajax({
			type: 'POST',
			url: 'bene_edit_query.php?ce_id=' + $ce_id,
			data: {category : $category, date_assess: $date_assess, ben_lname: $ben_lname, ben_fname: $ben_fname, ben_mname: $ben_mname, ben_ext: $ben_ext, ben_sex: $ben_sex, ben_age: $ben_age, ben_reg: $ben_reg,
				ben_prov: $ben_prov, ben_city: $ben_city, ben_bgy: $ben_bgy, ben_st: $ben_st, rep_rel_ben: $rep_rel_ben, other_rel: $other_rel, rep_lname: $rep_lname, rep_fname: $rep_fname, rep_mname: $rep_mname,
				rep_ext: $rep_ext, gis: $gis, pantawid_id: $pantawid_id, just: $just, med_cert_abs: $med_cert_abs, prescript: $prescript, soa: $soa, treat_proc: $treat_proc, quotation: $quotation, dis_sum: $dis_sum,
				lab_req: $lab_req, charge_slip: $charge_slip, funeral_cont: $funeral_cont, death_cert: $death_cert, det_sum: $det_sum, ref_let: $ref_let, soc_cas_stud_rep: $soc_cas_stud_rep, val_id: $val_id, other_doc: $other_doc, 
				toa: $toa, toa_medical: $toa_medical, toa_funeral: $toa_funeral, toa_financial: $toa_financial, toa_material: $toa_material, amount: $amount, a_year: $a_year, social_worker: $social_worker, ciu_head: $ciu_head,
				sdo_id: $sdo_id, swo_admin: $swo_admin
			},
			success: function(){
				//location.reload();
				window.location.href = 'benelist.php';
			}
			
		});
	});
	// Requirements upload
	$('#upload_req').click(function () {
			
			// add tayo ng form_data na lang para sure na mabind yung values
			var form_data = new FormData();
			var ce_id = $('#ce_id').val();

			form_data.append('ce_id', ce_id);
			// pic upload
			
			form_data.append("gis[]", document.getElementById('gis').files[0]);
			form_data.append("pantawid_id[]", document.getElementById('pantawid_id').files[0]);
			form_data.append("just[]", document.getElementById('just').files[0]);
			form_data.append("med_cert_abs[]", document.getElementById('med_cert_abs').files[0]);
			form_data.append("prescript[]", document.getElementById('prescript').files[0]);
			form_data.append("soa[]", document.getElementById('soa').files[0]);
			form_data.append("treat_proc[]", document.getElementById('treat_proc').files[0]);
			form_data.append("quotation[]", document.getElementById('quotation').files[0]);
			form_data.append("dis_sum[]", document.getElementById('dis_sum').files[0]);
			form_data.append("lab_req[]", document.getElementById('lab_req').files[0]);
			form_data.append("charge_slip[]", document.getElementById('charge_slip').files[0]);
			form_data.append("funeral_cont[]", document.getElementById('funeral_cont').files[0]);
			form_data.append("death_cert[]", document.getElementById('death_cert').files[0]);
			form_data.append("det_sum[]", document.getElementById('det_sum').files[0]);
			form_data.append("ref_let[]", document.getElementById('ref_let').files[0]);
			form_data.append("soc_cas_stud_rep[]", document.getElementById('soc_cas_stud_rep').files[0]);
			form_data.append("valid_id[]", document.getElementById('valid_id').files[0]);
			form_data.append("cert_indigency[]", document.getElementById('cert_indigency').files[0]);
			form_data.append("other_req[]", document.getElementById('other_req').files[0]);
					$.ajax({
					type: 'POST',
					url: 'requirements_query.php',
					data: form_data,
					contentType: false,
					processData: false,
					dataType: 'text',
					success: function () {
							console.log(form_data);
							// window.location = 'requirements.php';
							//location.reload();
					}
					});
							
		
		});
		//Save CA
		$('#add_ca').click(function(){
			$sdo_id = $('#myModal #sdo_id').val();
			$noca = $('#myModal #noca').val();
			$amount_ca = $('#amount_ca').val();
			$responsible_center = $('#responsible_center').val();
			
			$ors_num = $('#ors_num').val();
			$dv_num = $('#dv_num').val();
			$uacs_object_num = $('#uacs_object_num').val();

			$.ajax({
				url: "cash_advance_query.php",
				method: "POST",
				data:{ //$(this).serialize()
					sdo_id : $sdo_id, noca: $noca, amount_ca: $amount_ca,responsible_center:$responsible_center, ors_num: $ors_num,dv_num: $dv_num, uacs_object_num : $uacs_object_num
					},
				success: function() {
					// if (result==1) {
					//     $("#formSubmit").trigger("reset");
					//     //alert("Data insert in database successfully");
					// }
					//$('#result').html(data);
					location.reload();
				}
			});
	});
});