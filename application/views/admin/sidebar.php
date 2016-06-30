<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <div class="menu_section">
        <ul class="nav side-menu">
            <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo site_url('admin/profile') ?>">Profil Administrator</a>
                    </li>
                </ul>
            </li>
            
            <li><a><i class="fa fa-users"></i> Peserta <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo site_url('admin/member/add') ?>">Input Peserta</a>
                    </li>
                    <li><a href="<?php echo site_url('admin/member') ?>">List Peserta</a>
                    </li>
                </ul>
            </li>
            
            <li><a><i class="fa fa-clock-o"></i> Presensi <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo site_url('admin') ?>">Input Absensi</a>
                    </li>
                    <li><a href="<?php echo site_url('admin/present') ?>">Report Absensi</a>
                    </li>                   
                </ul>
            </li>

            <li><a><i class="fa fa-envelope"></i> Surat Keterangan <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo site_url('admin/sk') ?>">Daftar Surat Keterangan</a>
                    </li>                   
                </ul>
            </li>

            <li><a><i class="fa fa-newspaper-o"></i> Posting Berita <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo site_url('admin/posts') ?>">Daftar Posting</a>
                    <li><a href="<?php echo site_url('admin/posts/category') ?>">Category Posting</a>
                    </li>
                </ul>
            </li>

            <li><a><i class="fa fa-picture-o"></i> Media Manager <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo site_url('admin/media_manager') ?>">Image List</a>
                    <li><a href="<?php echo site_url('admin/media_album') ?>">Album List</a>
                    </li>
                </ul>
            </li>           

            <li><a><i class="fa fa-user-md"></i> User Management <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo site_url('admin/user') ?>">List User</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

</div>
<!-- /sidebar menu -->