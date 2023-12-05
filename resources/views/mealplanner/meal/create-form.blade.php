<div class="form-group">
    <label class="strong">Choose a format that best fits your recipe</label>
    <div class="recipes-form__style">
        <label
            class="recipes-form__style-label simple >
        <input type= active"
            radio="" name="recipe_style">Simple
        </label>
        <label class="recipes-form__style-label two-part-i">
            <input type="radio" name="recipe_style"
                data-parsley-multiple="recipe_style">Two-Part<br>Ingredient List
        </label>
        <label class="recipes-form__style-label two-part-r">
            <input type="radio" name="recipe_style"
                data-parsley-multiple="recipe_style">Two-Part Recipe
        </label>
    </div>
    <hr>
</div>
<div class="form-group">
    <label class="strong">List your ingredients one at a time</label>
    <div class="ingredients2" style="display: none;">
        <input type="text" name="ingredient_name_1" value=""
            class="form-control" placeholder="Name your first set of ingredients">
    </div>
</div>
<div class="analyze-your-meal form-group">
    <input id="analyze-version" type="hidden" value="" name="ver">
    <div class="row">
        <div class="col-md-12 core">
            <div class="row">
                <div class="col-md-12">
                    <h3><span>Analyze your meal</span>
                        <div class="tips" data-bs-toggle="modal"
                            data-bs-target="#myModalTips">Tips
                        </div>
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <textarea class="form-control analyze" id="ingredients" name="ingr_textarea_1"
                        placeholder="For example:
                1 cup orange juice
                3 tablespoons olive oil
                2 carrots"
                        rows=""></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">

        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
            <a class="more analyze_data" id="homeAnalyzeBtn">Analyze</a>
        </div>
    </div>
</div>
<div class="ingredients2 form-group">
    <hr>
    <!--for TWO-PART
INGREDIENT LIST TWO-PART RECIPE-->
    <div class="form-group">
        <span class="ingredient-name-2-help-block" style="display: none;color: red;">This
            field is
            required</span>
        <input type="text" name="ingredient_name_2" value=""
            class="form-control" placeholder="Name your second set of ingredients">
    </div>
    <span class="ingredient-help-block-2" style="display: none;color: red;">please add
        ingredient</span>
    <div class="analyze-your-meal form-group">
        <input id="" type="hidden" value="" name="ver">
        <div class="row">
            <div class="col-md-12 core">
                <div class="row">
                    <div class="col-md-12">
                        <h3><span>Analyze your meal</span>
                            <div class="tips" data-bs-toggle="modal"
                                data-bs-target="#myModalTips">Tips
                            </div>
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <textarea class="form-control analyze" id="ingredients-2" name="ingr_textarea_1"
                            placeholder="For example:
                    1 cup orange juice
                    3 tablespoons olive oil
                    2 carrots"
                            rows="" autocomplete="off"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">

            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <a class="more analyze_data-2">Analyze</a>

            </div>
        </div>
    </div>
    <hr>
</div>
<div class="ingredients-new form-group">
    <div class="show-all-list-div">
    </div>
</div>

<div class="mobile-view">

</div>
<div class="form-group">
    <label class="strong">Add your instructions one at a time</label>
</div>
<div class="form-group">
    <span class="preparation-help-block" style="display: none;color: red;">please add
        preparation</span>
    <label for="method" class="strong">Preparation *</label>
    <span class="epic-tooltip tooltipstered" rel="tooltip" data-toggle="tooltip"
        data-placement="left">
        <i class="fa fa-question-circle"></i>
    </span>
    <div class="optionBox">
        <div class="blockk preparation-1-div">
            <label for="body00" class="css-v23pgw"><span class="css-hlp6ko">Step
                    1</span></label>
            <div class="transparent-bg"></div>
            <textarea class="form-control steps forfocuss preparation-1-input" name="meal_preparation_1[0]"></textarea><span class="icon__remove remove preparation-1"
                data-step="0" aria-label="Remove step"></span>

        </div>
        <div class="blockk preparation-1-div">
            <label for="body00" class="css-v23pgw"><span class="css-hlp6ko">Step
                    2</span></label>
            <div class="transparent-bg"></div>
            <textarea class="form-control steps forfocuss preparation-1-input" name="meal_preparation_1[1]"></textarea><span class="icon__remove remove preparation-1"
                data-step="1" aria-label="Remove step"></span>

        </div>
        <div class="blockk"> <span class="add preparation-1">+ Add another step</span>

        </div>
    </div>
    <hr>
    <div class="optionBox preparation2">
        <span class="preparation-help-block-2" style="display: none;color: red;">please
            add preparation</span>
        <div class="blockk preparation-2-div">
            <label for="body00" class="css-v23pgw"><span class="css-hlp6ko">Step
                    1</span></label>
            <div class="transparent-bg"></div>
            <textarea class="form-control steps forfocuss preparation-2-input" name="meal_preparation_2[0]"></textarea><span class="icon__remove remove preparation-2"
                data-step="0" aria-label="Remove step"></span>
        </div>
        <div class="blockk preparation-2-div">
            <label for="body00" class="css-v23pgw"><span class="css-hlp6ko">Step
                    2</span></label>
            <div class="transparent-bg"></div>
            <textarea class="form-control steps forfocuss preparation-2-input" name="meal_preparation_2[1]"></textarea><span class="icon__remove remove preparation-2"
                data-step="1" aria-label="Remove step"></span>
        </div>
        <div class="blockk"> <span class="add preparation-2">+ Add another step</span>

        </div>
        <hr>
    </div>

</div>