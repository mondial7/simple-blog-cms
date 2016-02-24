	<header>
		<div class="center">
		    <h1 id="logo">
		        <a href="../../<?php if($forcelang!=null) print $forcelang; ?>" title="<?php print $lang['title']; ?>"><span><?php print $lang['title']; ?></span></a>
		    </h1>
			<nav>
			    <div id="nav_icon"></div>
			    <ul>
			        <li><a href="#" onclick="enable_searching()" class="t3"><div id="search_icon"></div><?php print $lang['search']; ?></a></li>
    			    <li><a href="../../contacts/<?php if($forcelang!=null) print $forcelang; ?>" class="t3"><?php print $lang['contacts']; ?></a></li>
    			</ul>
            </nav>
		</div>
	</header>