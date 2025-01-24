<!-- code category -->


{* Safely check if 'type' and 'district' are defined in the GET parameters *}
{assign var="selected_type" value=""}
{assign var="selected_district" value=""}

{if isset($smarty.get.types) && $smarty.get.types != ""}
{assign var="selected_type" value=$smarty.get.types}
{/if}

{if isset($smarty.get.district) && $smarty.get.district != ""}
{assign var="selected_district" value=$smarty.get.district}
{/if}

<div class="col-6">
    <h5 class="mb-3 fw-bold">Type</h5>
    <div class="wrapper">
        <div class="select_wrap">
            <ul id="default_types" class="default_option">
                <li data-value="">Select...</li>
            </ul>
            <ul id="select_ul_types" class="select_ul">
                <li data-value="">Select...</li>
                {foreach from=$categories item=category}
                {if isset($category->alias) && $category->alias == 'types'}
                {if isset($category->children) && $category->children|count > 0}
                {foreach from=$categories item=child}
                {if in_array($child->category_id, $category->children)}
                <li data-value="{$child->alias}">{$child->name}</li>
                {/if}
                {/foreach}
                {/if}
                {/if}
                {/foreach}
            </ul>
        </div>
    </div>
</div>

<div class="col-6">
    <h5 class="mb-3 fw-bold">District</h5>
    <div class="wrapper">
        <div class="select_wrap">
            <ul id="default_district" class="default_option">
                <li data-value="">Select...</li>
            </ul>
            <ul id="select_ul_district" class="select_ul">
                <li data-value="">Select...</li>
                {foreach from=$categories item=category}
                {if isset($category->alias) && $category->alias == 'district'}
                {if isset($category->children) && $category->children|count > 0}
                {foreach from=$categories item=child}
                {if in_array($child->category_id, $category->children)}
                <li data-value="{$child->alias}">{$child->name}</li>
                {/if}
                {/foreach}
                {/if}
                {/if}
                {/foreach}
            </ul>
        </div>
    </div>
</div>









<!--<pre>-->
<!--     {$categories|print_r} -->
<!--</pre>-->

<!--{foreach from=$categories item=category}-->
<!-- {$category->name}-->
<!--{/foreach}-->


<!-- =======================================js========================= -->


// Handle Type Dropdown
$("#default_types").click(function () {
$(this).parent().toggleClass("active");
});

$("#select_ul_types li").click(function (e) {
e.preventDefault();
var selectedText = $(this).text(); // Get the displayed name
var selectedValue = $(this).data("value"); // Get the alias (data-value)

// Update the default option with the selected item
$("#default_types li")
.html(selectedText)
.attr("data-value", selectedValue); // Update the visible text and data-value attribute

console.log("Selected Type:", selectedText);
console.log("Selected Value:", selectedValue);

$(this).parents(".select_wrap").removeClass("active");

// Trigger URL change for filtering
var districtValue = $("#default_district li").attr("data-value");
window.location.href = `${window.location.pathname}?types=${selectedValue}&district=${districtValue}`;
});

// Handle District Dropdown
$("#default_district").click(function () {
$(this).parent().toggleClass("active");
});

$("#select_ul_district li").click(function (e) {
e.preventDefault();
var selectedText = $(this).text(); // Get the displayed name
var selectedValue = $(this).data("value"); // Get the alias (data-value)

// Update the default option with the selected item
$("#default_district li")
.html(selectedText)
.attr("data-value", selectedValue); // Update the visible text and data-value attribute

console.log("Selected District:", selectedText);
console.log("Selected Value:", selectedValue);

$(this).parents(".select_wrap").removeClass("active");

// Trigger URL change for filtering
var typeValue = $("#default_types li").attr("data-value");
window.location.href = `${window.location.pathname}?types=${typeValue}&district=${selectedValue}`;
});