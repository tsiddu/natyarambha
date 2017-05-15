<?php
if($url_validater!=1)
{
echo "access denied";
die();
}


function home_user()
{
	?>
	<div class="carousel-inner">
				<div class="item active">
						<img alt="" src="http://test.schemax.in/natyam/images/Group.jpg" />
						<div class="carousel-caption">
							<h4>
								Bharatha Natyam
							</h4>
							<p>
								A possible origin of the name is from Bharata Muni, who wrote the Natya Shastra to which Bharata Natyam owes many of its ideas.
							</p>
						</div>
					</div>
				</div>
	<?php
}

function home_home()
{
	?>
	<div class="carousel-inner">
				<div class="item active">
						<img alt="" src="http://test.schemax.in/natyam/images/Group.jpg" />
						<div class="carousel-caption">
							<h4>
								Bharatha Natyam
							</h4>
							<p>
								A possible origin of the name is from Bharata Muni, who wrote the Natya Shastra to which Bharata Natyam owes many of its ideas.
							</p>
						</div>
					</div>
				</div>
	<?php
}

function home_plans()
{
	echo "plans page";
}

function home_about()
{
	echo "about us page";
}