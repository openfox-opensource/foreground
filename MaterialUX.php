		<!-- create page UX -->
		<div class="kwiki-mat"></div>
		<div class="fixed-action-btn active" id="kwiki-ux" style="bottom: 45px; right: 24px;">
          <form action="/%D7%9E%D7%99%D7%95%D7%97%D7%93:CreatePageRedirect" method="post"  class="createpageform">
            <input  class="btn-floating btn-large red pagenameinput" name="pagename" autocomplete="off">
            <input type="hidden" name="pagens">&nbsp;<input type="submit" value="mode_edit" name="createpage" class="material-icons createpage" title="צור דף חדש">
			<label class="ux_label"><div>צור דף</div></label>
		  </form>
  
          <a>
           
          
          </a>
          <ul>
            <li><a href="#" data-reveal-id="catModal" class="btn-floating yellow darken-1" style="transform: scaleY(1) scaleX(1) translateY(0px) translateX(0px); opacity: 1;"><i class="material-icons">local_offer</i></a><label class="ux_label"><div>ערוך קטגוריות</div></label></li>
            <li><a href="#" data-reveal-id="fileModal" class="btn-floating orange" style="transform: scaleY(1) scaleX(1) translateY(0px) translateX(0px); opacity: 1;"><i class="material-icons">image</i></a><label class="ux_label"><div>רשימת קבצים</div></label></li>
            <li><a class="btn-floating blue" style="transform: scaleY(1) scaleX(1) translateY(0px) translateX(0px); opacity: 1;" href="#" data-reveal-id="myModal"><i class="material-icons">attach_file</i></a><label class="ux_label"><div>העלה קובץ</div></label></li>
            <li>
				<form action="/%D7%9E%D7%99%D7%95%D7%97%D7%93:CreatePageRedirect" method="post"  class="createpageform lock">
					<i class="material-icons">lock</i>
					<input  class="btn-floating btn-large green pagenameinput" name="pagename" autocomplete="off">
					<input type="hidden" value="מוגבל" name="pagens">&nbsp;<input type="submit" value="mode_edit" name="createpage" class="material-icons createpage" title="צור דף פנימי חדש">
					</a><label class="ux_label"><div>צור דף פנימי</div>
				</form>
			</li>
			</ul>
        </div>