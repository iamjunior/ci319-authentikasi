Hello Member, Anda Berhasil Login<br/>
ID = <?= $this->session->userdata('userId')?><br/>
LGN= <?= $this->session->userdata('loggedIn')?><br/>
<a href="<?= site_url('logout')?>">Logout</a>