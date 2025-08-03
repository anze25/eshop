<form class="form-search flex-grow">
    <fieldset class="name">
        <input
            id="search-input"
            type="text"
            placeholder="@lang('Search')..."
            class="show-search"
            name="name"
            tabindex="2"
            value=""
            aria-required="true"
            required=""
            autocomplete="off"
            data-search-type=""
        >
    </fieldset>
    <div class="button-submit">
        <button
            class=""
            type="submit"
        ><i class="icon-search"></i></button>
    </div>
    <div class="box-content-search">
        <ul id="box-content-search"></ul>
    </div>
</form>
