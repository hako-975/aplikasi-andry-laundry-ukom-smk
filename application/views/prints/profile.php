<div class="container">
	<div class="row justify-content-center my-4">
		<div class="col-10">
			<div class="card bg-info p-4 rounded text-white mb-3">
			  <div class="row position-absolute" style="right: 5px; top: 5px">
			  	<div class="col">
			  		<img width="100" src="<?= base_url('assets/img/img_properties/qr-code.png'); ?>" alt="qr-code">
			  	</div>
			  </div>
			  <div class="row no-gutters">
			    <div class="col-2 mt-4">
			    	<a href="<?= base_url('assets/img/img_profiles/') . $userProfile['foto']; ?>" class="enlarge">
				      <img width="150" src="<?= base_url('assets/img/img_profiles/') . $userProfile['foto']; ?>" class="card-img" alt="<?= $userProfile['foto']; ?>">
			    	</a>
			    	<h6 class="font-weight-bold mt-2 pt-2 mb-1 pb-0">Username : </h6>
			    	<h6 class="font-weight-bold mb-2 pb-2 mt-1 pt-0"><?= $userProfile['username']; ?></h6>
			    </div>
			    <div class="col-9">
			      <div class="card-body my-auto">
			      	<table>
			      		<tr>
			      			<th style="width: 8.6rem!important">Nama Lengkap</th>
			      			<td class="px-3"> : </td>
			      			<td class="text-break"><?= ucwords(strtolower($userProfile['nama_lengkap'])); ?></td>
			       		</tr>
			       		<tr>
			      			<th style="width: 8.6rem!important">Tempat Lahir</th>
			      			<td class="px-3"> : </td>
			      			<td class="text-break"><?= $userProfile['tempat_lahir']; ?></td>
			       		</tr>
			       		<tr>
			      			<th style="width: 8.6rem!important">Tanggal Lahir</th>
			      			<td class="px-3"> : </td>
			      			<td class="text-break"><?= $userProfile['tanggal_lahir']; ?></td>
			       		</tr>
			       		<tr>
			      			<th style="width: 8.6rem!important">Jenis Kelamin</th>
			      			<td class="px-3"> : </td>
			      			<td class="text-break"><?= ucwords($userProfile['jenis_kelamin']); ?></td>
			       		</tr>
			       		<tr>
			      			<th style="width: 8.6rem!important">Golongan Darah</th>
			      			<td class="px-3"> : </td>
			      			<?php if ($userProfile['golongan_darah'] == ""): ?>
			      				<td>-</td>
			      			<?php else: ?>
			      				<td class="text-break"><?= strtoupper($userProfile['golongan_darah']); ?></td>
			      			<?php endif ?>
			       		</tr>
			       		<tr>
			      			<th style="width: 8.6rem!important">No. Telepon</th>
			      			<td class="px-3"> : </td>
			      			<td class="text-break"><?= $userProfile['telepon']; ?></td>
			       		</tr>
			       		<tr>
			      			<th style="width: 8.6rem!important">Email</th>
			      			<td class="px-3"> : </td>
			      			<?php if ($userProfile['email'] == ""): ?>
			      				<td>-</td>
			      			<?php else: ?>
				      			<td class="text-break"><?= $userProfile['email']; ?></td>
				      		<?php endif ?>
			       		</tr>
			       		<tr>
			      			<th style="width: 8.6rem!important">Alamat</th>
			      			<td class="px-3"> : </td>
			      			<td class="text-break"><?= $userProfile['alamat']; ?></td>
			       		</tr>
			      	</table>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</div>

</div>
