
<!-- modal upload -->
<div id="myModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
  <h2 id="modalTitle">יצירת דף</h2>
	<div class="modal-body">
		<form action="" id="mw-create-form">			
			<fieldset>
				<legend>קטגוריות</legend>
				<label>בחר 
					<select class="chosen-select chosen-rtl" multiple>
					  <option value="husker">Husker</option>
					  <option value="starbuck">Starbuck</option>
					  <option value="hotdog">Hot Dog</option>
					  <option value="apollo">Apollo</option>
					</select>
				</label>
			</fieldset>
			<fieldset>
				<legend>מרחב שם</legend>
				<label>בחר 
					<select class="chosen-select chosen-rtl">
					  <option value="husker">Husker</option>
					  <option value="starbuck">Starbuck</option>
					  <option value="hotdog">Hot Dog</option>
					  <option value="apollo">Apollo</option>
					</select>
				</label>
			</fieldset>
			<fieldset>
				<legend>תבנית</legend>
				<label>בחר 
					<select class="chosen-select chosen-rtl">
					  <option value="husker">Husker</option>
					  <option value="starbuck">Starbuck</option>
					  <option value="hotdog">Hot Dog</option>
					  <option value="apollo">Apollo</option>
					</select>
				</label>
			</fieldset>
		</form>
	</div>
	<div class="modal-footer">
        <button type="submit" id="submit-all" class="btn-large btn-floating green right">          
			<i class="material-icons">done</i>
        </button>
    </div>
	<a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>

<!-- modal category -->

<div id="catModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
  <h2 id="modalTitle">ערוך קטגוריות</h2>
		    	<div class="group catModal" id="modalCategory"><?php $this->html('catlinks'); ?></div>
  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>

<!-- modal files -->
<div id="fileModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
  <h2 id="modalTitle">כל הקבצים</h2>
	<iframe src="/%D7%A8%D7%A9%D7%99%D7%9E%D7%AA_%D7%A7%D7%91%D7%A6%D7%99%D7%9D?action=render"></iframe>
  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>