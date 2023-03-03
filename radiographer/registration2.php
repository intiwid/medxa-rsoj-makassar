<?php
require '../koneksi/koneksi.php';
session_start();
if ($_SESSION['level'] == "radiographer") {
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<?php include('head.php'); ?>
		<title>Registration | Radiographer</title>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<div id="container1">
			<div id="content1">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb1 breadcrumb">
						<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
						<li class="breadcrumb-item active" aria-current="page"><?= $lang['registration'] ?></li>

					</ol>
				</nav>
				<!-- <div class="container-fluid">
								<div class="row">
												<div class="col-sm-1 col-sm-offset-10 controls">
																<div class="menu-size">
																				<div class="label-font"><center><label>Zoom</label></center>
																</div>
																<div class="font-size">
																				<center>
																				<a href="#" id="decfont"><i class="fas fa-minus-circle"></i></a>
																				<a href="#" id="incfont"><i class="fas fa-plus-circle"></i></a>
																				</center>
																</div>
												</div>
								</div>
				</div>
			</div> -->

				<div class="body">


					<div class="container-fluid">
						<div class="row">
							<h3 class="textsearchnewpasien2"><?= $lang['search_patient'] ?></h3>

							<form method="post" action="inputorder.php">

								<div class="content1 col-sm-4 border-reg" style="padding: 0px;">
									<label class="reg-1">MRN</label><br>
									<div class="wrap-search1">
										<span class="search-icon2"><i class="ic-search fas fa-search"></i>
											<input class="search-input-reg" type="text" name="mrn" placeholder="<?= $lang['input_mrn'] ?>">
										</span>
									</div>
								</div>
								<div class="content1 col-sm-4 border-reg" style="padding: 0px;">
									<label class="reg-1"><?= $lang['f_name'] ?></label><br>
									<div class="wrap-search1">
										<span class="search-icon2"><i class="ic-search fas fa-search"></i>
											<input class="search-input-reg" type="text" name="name" value="" placeholder="<?= $lang['search_f_name'] ?>">
										</span>
									</div>
								</div>
								<div class="content1 col-sm-4" style="padding: 0px;">
									<label class="reg-1"><?= $lang['l_name'] ?></label><br>
									<div class="wrap-search1">
										<span class="search-icon2"><i class="ic-search fas fa-search"></i>
											<input class="search-input-reg" type="text" name="lastname" placeholder="<?= $lang['search_l_name'] ?> ">
										</span>
									</div>
								</div>
								<button class="btn buttonsearch" type="submit" name="submit2">
									<i class="fas fa-search"></i><span> <?= $lang['find'] ?></span>
								</button>

							</form>
						</div>
					</div>





					<div class="container-fluid">
						<h3 class="textsearchnewpasien2"><?= $lang['regist_new_patient'] ?></h3>
						<div style="margin: 0px 0px;" class="row regist">

							<div class="col-sm-3">
								<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
									consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
									cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
									proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
							</div>
							<form action="afterregist.php" method="post">

								<div class="col-sm-4">
									<table class="table-form">
										<tr>
											<td><label for="mrn"><b>MRN</b></label></td>
											<td><input type="text" name="mrn" id="mrn" maxlength="10" placeholder="<?= $lang['input_mrn'] ?>" required></td>
										</tr>
										<tr>
											<td><label for="name"><b><?= $lang['name'] ?></b></label></td>
											<td><input style="width: 49%;" type="text" name="name" id="name" placeholder="<?= $lang['input_f_name'] ?>" required>&nbsp;&nbsp;&nbsp;&nbsp;<input style="width: 49%;" type="text" name="lastname" id="lastname" placeholder="<?= $lang['input_l_name'] ?>"></td>
										</tr>


										<!-- <label for="ssn"><b>No. KTP</b></label><br>
									<input type="text"	name="ssn" id="ssn" placeholder="Masukan Nomer KTP.." maxlength="16"><br><br> -->
										<tr>
											<td><label for="sex"><b><?= $lang['sex'] ?></b></label></td>
											<td><label class="radio-admin">
													<input type="radio" checked="checked" name="sex" value="M" required> <?= $lang['male'] ?>
													<span class="checkmark"></span>
												</label>
												<label class="radio-admin">
													<input type="radio" name="sex" value="F" required> <?= $lang['female'] ?>
													<span class="checkmark"></span>
												</label>
												<label class="radio-admin">
													<input type="radio" name="sex" value="O" required> <?= $lang['other'] ?>
													<span class="checkmark"></span>
												</label>
											</td>
										</tr>
										<tr>
											<td><label for="birth_date"><b><?= $lang['birth_date'] ?></b></label></td>
											<td><input type="text" name="birth_date" id="birth_date" placeholder="<?= $lang['input_birth_date'] ?>" autocomplete="off" required></td>
										</tr>
										<tr>
											<td><label for="road"><b><?= $lang['weight'] ?></b></label></td>
											<td><input type="text" name="weight" id="road" placeholder="<?= $lang['input_weight'] ?>"></td>
										</tr>
										<tr>
											<td><label for="address"><b><?= $lang['address'] ?></b></label></td>
											<td><textarea type="text" name="address" id="address" placeholder="<?= $lang['input_address'] ?>"></textarea></td>
										</tr>
										<tr>
											<td><label for="road"><b><?= $lang['village'] ?></b></label></td>
											<td><input type="text" name="village" id="road" placeholder="<?= $lang['input_village'] ?>"></td>
										</tr>
										<tr>
											<td><label for="village"><b><?= $lang['sub_district'] ?></b></label></td>
											<td><input type="text" name="sub_district" id="village" placeholder="<?= $lang['input_sub_district'] ?>"></td>
										</tr>
									</table>
								</div>
								<div class="col-sm-4">
									<table class="table-form">
										<tr>
											<td><label for="amphoe_code"><b><?= $lang['city'] ?></b></label></td>
											<td><input type="text" name="city" id="amphoe_code" placeholder="<?= $lang['input_city'] ?>"></td>
										</tr>
										<tr>
											<td><label for="province_code"><b><?= $lang['province'] ?></b></label></td>
											<td><input type="text" name="province" id="province_code" placeholder="<?= $lang['input_province'] ?>"></td>
										</tr>
										<tr>
											<td><label for="tambon_code"><b><?= $lang['zip'] ?></b></label></td>
											<td><input type="text" name="post_code" id="tambon_code" maxlength="5" placeholder="<?= $lang['input_zip'] ?>"></td>
										</tr>
										<tr>
											<td><label for="country_code"><b><?= $lang['country'] ?></b></label></td>
											<td><select name="country" id="country_code">
													<option value=""><?= $lang['input_country'] ?></option>
													<option value="indonesia">Indonesia</option>
												</select></td>
										</tr>
										<!-- <input type="text"	name="country" id="country_code" placeholder="Masukan Negara.."><br> -->

										<tr>
											<td><label for="note"><b><?= $lang['note'] ?></b></label></td>
											<td><textarea type="text" name="note" id="note" placeholder="<?= $lang['input_note'] ?>"></textarea></td>
										</tr>
										<tr>
											<div class="container-fluid">
												<div class="row">

													<td><label for="phone"><b><?= $lang['no_telp'] ?></b></label></td>
													<td>
														<div style="padding: 0px 0px" class="col-sm-3">
															<select name="kodearea" r>
																<option value="+62"> +62 | Indonesia</option>
																<option value="+60">+60 | Malaysia</option>
																<option value="+95">+95 | Myanmar</option>
																<option value="+673">+673 | Brunei Darussalam</option>
																<option value="+855">+855 | Kamboja</option>
																<option value="+856">+856 | Laos</option>
																<option value="+670">+670 | Timor Leste</option>
																<option value="+65">+65 | Singapura</option>
																<option value="+66">+66 | Thailand</option>
																<option value="+63">+63 | Filipina</option>
															</select>
														</div>
														<div style="padding: 0px 0px" class="col-sm-9">
															<input type="text" name="phone" id="phone" placeholder="<?= $lang['input_telp'] ?>">
														</div>
													</td>
												</div>
											</div>
										</tr>
										<tr>
											<td><label for="email"><b>E-Mail</b></label></td>
											<td><input type="text" name="email" id="email" placeholder="<?= $lang['input_email'] ?>"></td>
										</tr>
									</table>
									<button class="btn buttonsearch2" type="submit" name="submit"><span><b><?= $lang['add_data'] ?></b></span></button>
								</div>
						</div>


						</form>
					</div>
				</div>
				<div class="container-fluid">
					<h3 class="textsearchnewpasien2"><?= $lang['regist_new_patient'] ?></h3>
					<div style="margin: 0px 0px;" class="row regist">

						<div class="col-sm-3">
							<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
						</div>
						<form action="afterregist.php" method="post">

							<div class="col-sm-4">
								<label>Acount</label>

								<div class="input-group input-group-icon">
									<input type="text" class="input-new" placeholder="Full Name">
									<div class="input-icon"><i class="fa fa-user"></i></div>
								</div>


							</div>
							<div class="col-sm-4">
								<table class="table-form">
									<tr>
										<td><label for="amphoe_code"><b><?= $lang['city'] ?></b></label></td>
										<td><input type="text" name="city" id="amphoe_code" placeholder="<?= $lang['input_city'] ?>"></td>
									</tr>
									<tr>
										<td><label for="province_code"><b><?= $lang['province'] ?></b></label></td>
										<td><input type="text" name="province" id="province_code" placeholder="<?= $lang['input_province'] ?>"></td>
									</tr>
									<tr>
										<td><label for="tambon_code"><b><?= $lang['zip'] ?></b></label></td>
										<td><input type="text" name="post_code" id="tambon_code" maxlength="5" placeholder="<?= $lang['input_zip'] ?>"></td>
									</tr>
									<tr>
										<td><label for="country_code"><b><?= $lang['country'] ?></b></label></td>
										<td><select name="country" id="country_code">
												<option value=""><?= $lang['input_country'] ?></option>
												<option value="indonesia">Indonesia</option>
											</select></td>
									</tr>
									<!-- <input type="text"	name="country" id="country_code" placeholder="Masukan Negara.."><br> -->

									<tr>
										<td><label for="note"><b><?= $lang['note'] ?></b></label></td>
										<td><textarea type="text" name="note" id="note" placeholder="<?= $lang['input_note'] ?>"></textarea></td>
									</tr>
									<tr>
										<div class="container-fluid">
											<div class="row">

												<td><label for="phone"><b><?= $lang['no_telp'] ?></b></label></td>
												<td>
													<div style="padding: 0px 0px" class="col-sm-3">
														<select name="kodearea" r>
															<option value="+62"> +62 | Indonesia</option>
															<option value="+60">+60 | Malaysia</option>
															<option value="+95">+95 | Myanmar</option>
															<option value="+673">+673 | Brunei Darussalam</option>
															<option value="+855">+855 | Kamboja</option>
															<option value="+856">+856 | Laos</option>
															<option value="+670">+670 | Timor Leste</option>
															<option value="+65">+65 | Singapura</option>
															<option value="+66">+66 | Thailand</option>
															<option value="+63">+63 | Filipina</option>
														</select>
													</div>
													<div style="padding: 0px 0px" class="col-sm-9">
														<input type="text" name="phone" id="phone" placeholder="<?= $lang['input_telp'] ?>">
													</div>
												</td>
											</div>
										</div>
									</tr>
									<tr>
										<td><label for="email"><b>E-Mail</b></label></td>
										<td><input type="text" name="email" id="email" placeholder="<?= $lang['input_email'] ?>"></td>
									</tr>
								</table>
								<button class="btn buttonsearch2" type="submit" name="submit"><span><b><?= $lang['add_data'] ?></b></span></button>
							</div>
					</div>


					</form>
				</div>
			</div>


		</div>
		</div>
		<div style="position: fixed;" class="footerindex">
			<div class="">
				<div class="footer-login col-sm-12"><br>
					<center>
						<p>&copy; Powered by Intiwid IT Solution 2022</a>.</p>
					</center>
				</div>
			</div>
		</div>
		</div>
		<?php include('script-footer.php'); ?>
		<script type="text/javascript" src="js/jquery.datetimepicker.full.js"></script>
		<link rel="stylesheet" type="text/css" media="screen" href="css/jquery.datetimepicker.min.css">
		<script>
			$(document).ready(function() {
				$("a[href='registration.php']").addClass("active-menu");
			});
		</script>
		<script>
			$(document).ready(function() {
				$('#birth_date').datetimepicker({
					timepicker: false,
					format: 'Y-m-d',
					startDate: '2000-01-02'
				});
			});
		</script>
		<?php
		mysqli_query($conn, "DELETE FROM xray_patient_order WHERE username = '$username' ");
		mysqli_query($conn, "DELETE FROM xray_dokter_order WHERE username = '$username' ");
		mysqli_query($conn, "DELETE FROM xray_department_order WHERE username = '$username'");
		mysqli_query($conn, "DELETE FROM xray_type_order WHERE username = '$username'");
		return mysqli_affected_rows($conn);
		?>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>