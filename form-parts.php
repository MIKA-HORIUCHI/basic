

<!-- textbox -->
<div class="form__item">
    <label class="form__title" for="textbox">ラベルの例</label>
    <input id="textbox" type="text" name="name" class="form__content textbox" value="<?=$name?>"  placeholder="テキストボックスの例" required>
</div>

<!-- selectbox -->
<label class="selectbox">
    <select>
        <option>optionの例1</option>
        <option>optionの例2</option>
        <option>optionの例3</option>
    </select>
</label>

<!-- radio button -->
<fieldset class="radio">
  <label>
      <input type="radio" name="radio" checked/>
      radio1
  </label>
  <label>
      <input type="radio" name="radio"/>
      radio2
  </label>
  <label>
      <input type="radio" name="radio"/>
      radio3
  </label>
</fieldset>

<!-- checkbox -->
<fieldset class="checkbox">
    <label>
        <input type="checkbox" name="checkbox" checked/>
        radio1
    </label>
    <label>
        <input type="checkbox" name="checkbox"/>
        radio2
    </label>
    <label>
        <input type="checkbox" name="checkbox"/>
        radio3
    </label>
</fieldset>