<nav id="sidebar" class="sidebar js-sidebar">
			
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.php">
          <span class="align-middle">Admin Panel</span>
                </a>
				<ul class="sidebar-nav">
				<li class="sidebar-item <?=($p=="dashboard"?"active":"")?>">
					<a class="sidebar-link" href="index.php">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                    </a>
				    </li>

                <li class="sidebar-item <?=($p=="slideshow"?"active":"")?>">
					<a class="sidebar-link" href="index.php?p=slideshow">
                    <i class="align-middle" data-feather="archive"></i> <span class="align-middle">Slideshow</span>
                    </a>
				    </li>

					 <li class="sidebar-item <?=($p=="product"? "active":"")?>">
					<a class="sidebar-link" href="index.php?p=product">
                    <i class="align-middle" data-feather="box"></i> <span class="align-middle">Product</span>
                    </a>
				    </li>

					 <li class="sidebar-item <?=($p=="categories"? "active":"")?>">
					<a class="sidebar-link" href="index.php?p=categories">
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Categories</span>
                    </a>
				    </li>

					 <li class="sidebar-item <?=($p=="brand"? "active":"")?>">
					<a class="sidebar-link" href="index.php?p=brand">
                    <i class="align-middle" data-feather="award"></i> <span class="align-middle">Brand</span>
                    </a>
				    </li>

					 <li class="sidebar-item <?=($p=="page"? "active":"")?>">
					<a class="sidebar-link" href="index.php?p=page">
                    <i class="align-middle" data-feather="file"></i> <span class="align-middle">Page</span>
                    </a>
				    </li>

					 <li class="sidebar-item <?=($p=="user"? "active":"")?>">
					<a class="sidebar-link" href="index.php?p=user">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">User</span>
                    </a>
				    </li>

					<li class="sidebar-item <?=($p=="setting"? "active":"")?>">
					<a class="sidebar-link" href="index.php?p=setting">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Setting</span>
                    </a>
				    </li>
				</ul>
			</div>
		</nav>