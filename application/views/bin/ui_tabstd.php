<!DOCTYPE html>
<!-- 
-> STUDENT
home_std
infotch_std
myGroup
commit_show

 -->
<a href="<?= base_url('Controller/home_std') ?>"> ประกาศ
  <!-- <img src="<?= base_url('./image/img_home.png') ?>" class="img-circle" height="65" width="65" alt="Avatar"> -->
</a><br>
<a href="<?= base_url('Controller/infotch_std')  ?>"> ข้อมูลอาจารย์
  <!-- <img src="<?= base_url('./image/img_teastd.png') ?>" class="img-circle" height="65" width="65" alt="Avatar"> -->
</a><br>
<form action='<?= base_url('Controller/myGroup') ?>' method='post'>
  <button class='btn colora'> กลุ่มของฉัน
    <input name="group_id" value='1' style='display: none'>
    <!-- <img src="<?= base_url('./image/img_logout.png') ?>" class="img-circle" height="65" width="65" alt="Avatar"> -->
  </button>
</form>
<a href="<?= base_url('Controller/commit_show') ?>"> กรรมการ(ส่วนรวม)
  <!-- <img src="<?= base_url('./image/img_home.png') ?>" class="img-circle" height="65" width="65" alt="Avatar"> -->
</a><br>
<a href="<?= base_url('Controller/test_show') ?>"> ดูคะแนน(other)
    <!-- <img src="<?= base_url('./image/importdata_admin.png') ?>" class="img-circle" height="65" width="65" alt="Avatar"> -->
</a><br>
<a href="<?= base_url('Controller/logout') ?>"> ออกจากระบบ
  <!-- <img src="<?= base_url('./image/img_logout.png') ?>" class="img-circle" height="65" width="65" alt="Avatar"> -->
</a><br>