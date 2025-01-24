<p>
  As seen in the <b>Usage</b> tab the most basic usage of the modle is by calling the <b>{ldelim}{$mod->GetName()}{rdelim}</b> tag in any of your frontend templates. However you can extend and control the module's behaviour with parameters in the tag.
</p>

<h3>Parameters</h3>

<p>
  This is a list of the parameters that can be used with the instance tag:
</p>
<ul>
  <li>
    <em>(optional)</em> <b>action = default</b> - Override the default action. The default action can be omitted. Possible values are:
    <ul>
      <li><b>default</b> - displays the summary view, and can be omitted.</li>
      <li><b>detail</b> - displays a specified entry in detail mode.</li>
      <li><b>search</b> - displays the search form. Optional parameters that affect to this action only: <em><b>filter</b></em>.</li>
      <li><b>category</b> - displays the categories. Optional parameters that affect to this action only: <em><b>show_items</b>, <b>collapse</b>, <b>number_of_levels</b></em>.</li>
      <li><b>archive</b> - displays the archives.</li>
    </ul>
  </li>
  <li>
    <em>(optional)</em> <b>orderby = item_position</b> - You can order by any of the following columns: <b>item_id</b>, <b>item_title</b>, <b>item_position</b>, <b>item_created</b>, <b>category_id</b>, <b>category_name</b>, <b>category_position</b>, <b>category_hierarchy</b>, <b>rand</b> and also by custom fields with <b>custom_*</b> (<b>*</b> would be the <em>field definition alias</em>).
    <p class="m_top_25">For example:</p>
      <ul>
        <li>orderby = 'category_name, item_title'</li>
        <li>
          <p>With fielddef values:</p>
          orderby='custom_<em>&lt;fielddef alias&gt;</em>'
        </li>
        <li>
          <p>You can also specify ascending or descending for any column, for example:</p>
          orderby='category_name|ASC, item_title|DESC'
        </li>
      </ul>

  </li>
  <div class="m_top_25"></div>
<li><em>(optional)</em> <b>showall = 0</b> - Show all items, irrespective of end date.</li>
<li><em>(optional)</em> <b>category = general</b> - Specify an alias or comma separated aliases of the category/categories displayed items must be a member of.</li>
<li><em>(optional)</em> <b>exclude_category = '<em>&lt;category_alias_1&gt;,&lt;category_alias_2&gt;[,...,&lt;category_alias_n&gt;]</em>'</b> - Specify an alias or comma separated aliases of the category/categories displayed items must not be a member of.</li>
<li><em>(optional)</em> <b>subcategory = false</b> - If parameter 'category' is specified, this parameter set to <em>true</em> will make allowance for subcategories' items. It is set to false by default.</li>
<li><em>(optional)</em> <b>detailpage = <em>&lt;alias/id&gt;</em></b> - Page to display item details in. Must be a page alias/id. Used to allow details to be displayed in a different page than summary.</li>
<li><em>(optional)</em> <b>summarypage = <em>&lt;alias/id&gt;</em></b> - Page to display item summary in. Must be a page alias/id. Used to allow summaries to be displayed in a different page than initiator.</li>
<li><em>(optional)</em> <b>item = <em>&lt;item_alias&gt;</em></b> - This parameter is only applicable to the detail view. It allows specifying which item to display in detail mode. Must be an item alias.</li>
  <li>
    <em>(optional)</em> <b>pagelimit = 10</b> - Maximum number of items to display (per page). If this parameter is not supplied all matching items will be displayed to a maximum of {$page_limit}. If it is, and there are more items available than specified in the parameter, text and links will be supplied to allow scrolling through the results.
  </li>
  <li><em>(optional)</em> <b>start = 2</b> - Start at the <b>n</b>th item -- leaving empty will start at the first item.</li>
  <li><em>(optional)</em> <b>search = '<em>&lt;some search text&gt;</em>'</b> - Search all fields. Uses <strong>fulltext</strong> search. Can be combined with filter search.</li>
  <li><em>(optional) <span style="color:green"><b>(new)</b></span></em> <b>srchop = '='</b> - used in combination with the existent full text search parameter sets the way used in the query either as an exact search <b>'='</b> or as an approximate search <b>'LIKE'</b> which is the default mode. <sup><b><i>(3)</i></b></sup></li>
  <li><em>(optional) <span style="color:orangered"><b>(deprecated)</b></span></em> <b>search_<em>&lt;fielddef_alias&gt;&gt;</em> = '<em>&lt;some search text&gt;</em>'</b> - Search a particular field. You can use 'title' or the alias of a field definition, e.g. search_title. Can be combined with fulltext search. Multiple search_* params can be combined. <sup><b><i>(1)(2)</i></b></sup></li>
  <li><em>(optional)</em> <b>filter = <em>&lt;category_alias_1&gt;,&lt;category_alias_2&gt;[,...,&lt;category_alias_n&gt;]</em></b> - Applies only to action: <em>search</em>. Specify the fields whose values should be offered as filter options by listing the field's aliases comma separated.</li>
  <li>
    <em>(optional)</em> filterorderby = 'value' - When filtering in a search action you can order by any of the following columns: <b>value</b>, <b>item_id</b>, <b>alias</b>, <b>title</b>, <b>position</b>, <b>create_time</b> and <b>modified_time</b>.
    <p>The use is similar to the one used in the <em>orderby</em> parameter. Also for this to have any effect, the <em>filter</em> parameter is required.</p>
    <p>There order of the comma separated list of filter aliases is used to determnine the order by which the <em>filterorderby</em> is applied.</p>
    <p class="m_top_25">For example:</p>
    <ul>
      <li>filter = '<em>&lt;fielddef_alias&gt;</em>' filterorderby = 'value|ASC' (default behaviour so <em>filterorderby</em> can be omitted in this case)</li>
      <li>
        <p>With multiple aliases to sort differently:</p>
        <p>filter = 'title,value,<em>&lt;fielddef_alias&gt;,&lt;fielddef_alias2&gt;[,...,&lt;category_alias_n&gt;]</em>' filterorderby='title,value|DESC' (ASC is default so can be omitted)</p>
        <p>This will sort the filter dropdowns or multiselect fields by title ASC and by value DESC respectively</p>
      </li>
    </ul>
  </li>
  <div class="m_top_25"></div>
  <li><em>(optional)</em> <b>collapse = false</b> - Applies only to action: <em>category</em>. Toggle collapse categories.</li>
  <li><em>(optional)</em> <b>show_items = false</b> - Applies only to action: <em>category</em>. Append items to category tree.</li>
  <li><em>(optional)</em> <b>number_of_levels = 2</b> - Applies only to action: <em>category</em>. Number of of category levels to show.</li>
  <li><em>(optional)</em> <b>include_items = '1,4,7[,...,n]'</b> - Specify an id/alias or comma separated ids/aliases of the items you want to display.</li>
  <li><em>(optional)</em> <b>exclude_items = '2,3,5[,...,n]'</b> - Specify an id/alias or comma separated ids/aliases of the items you want to exclude from list.</li>
  <li><em>(optional)</em> <b>template_detail = 'default'</b> - The detail template you wish to use.</li>
  <li><em>(optional)</em> <b>template_summary = 'default'</b> - The summary template you wish to use.</li>
  <li><em>(optional)</em> <b>template_search = 'default'</b> - The search template you wish to use.</li>
  <li><em>(optional)</em> <b>template_category = 'default'</b> - The category template you wish to use.</li>
  <li><em>(optional)</em> <b>template_archive = 'default'</b> - The category template you wish to use.</li>
  <li><em>(optional) <span style="color:orangered"><b>(deprecated)</b></span></em> <b>filter_year = '2000'</b> - Filter items by year. <sup><b><i>(1)(4)</i></b></sup></li>
  <li><em>(optional) <span style="color:orangered"><b>(deprecated)</b></span></em> <b>filter_month = '2'</b> - Filter items by month. <sup><b><i>(1)(4)</i></b></sup></li>
</ul>

<p><b>Notes:</b></p>
<p><b>(1)</b> This parameter has been replaced by a new set of parameters (see below) and is deprecated. It will be removed in the future.</p>
<p><b>(2)</b> Using search_* disables completely the extended search parameters.</p>
<p><b>(3)</b> Won't affect search_* parameters.</p>
<p><b>(4)</b> Using filter_year and/or filter_month disables completely the extended date filter parameters.</p>

<h3>New Extended Date Filter Parameters</h3>
<p>The <b><i>filter_year</i></b> and <b><i>filter_month</i></b> parameters have been deprecated and will be removed in the next major version upgrade of LISE. There is a new set of parameters to replace the previous functionality that you can use now with new and extended features. Using any of the old date filtering parameters will disable the use of the extended ones.</p>
<ul>
  <li><em>(optional) <span style="color:green"><b>(new)</b></span></em> <b>xf_startday = 1</b> - The day you wish to start to filter by in a range of days. Defaults to current day. <sup><b><i>(1)</i></b></sup></li>
  <li><em>(optional) <span style="color:green"><b>(new)</b></span></em> <b>xf_endday = 30</b> - The end day in a range of days you wish to filter by. Defaults to current day. <sup><b><i>(1)</i></b></sup></li>

  <li><em>(optional) <span style="color:green"><b>(new)</b></span></em> <b>xf_startmonth = 1</b> - The month you wish to start to filter by in a range of months. Defaults to current month. <sup><b><i>(1)</i></b></sup></li>
  <li><em>(optional) <span style="color:green"><b>(new)</b></span></em> <b>xf_endmonth = 12</b> - The end month in a range of months you wish to filter by. Defaults to current month. <sup><b><i>(1)</i></b></sup></li>

  <li><em>(optional) <span style="color:green"><b>(new)</b></span></em> <b>xf_startyear = 1910</b> - The year you wish to start to filter by in a range of years. Defaults to current year. <sup><b><i>(1)</i></b></sup></li>
  <li><em>(optional) <span style="color:green"><b>(new)</b></span></em> <b>xf_endyear = 2030</b> - The end year in a range of years you wish to filter by. Defaults to current year. <sup><b><i>(1)</i></b></sup></li>
</ul>

<p><b>Notes:</b></p>
<p><b>(1)</b> For the date filters to start working you only needs one of the date parameters: all other omitted will default to current time.</p>

<h3>New Extended Search Parameters</h3>

<p>The <b><i>search_*</i></b> parameters functionality has been deprecated and will be removed in the next major version upgrade of LISE. There is a new set of parameters to replace the previous functionality that you can use now with new and extended features.</p>
<p>The module will detect the use of <b><i>search_*</i></b> and ignore the extended parameters as they are mutually exclusive.</p>
<p>
  This is a list of the extended search parameters that can be used with the instance tag:
</p>

<ul>
  <li><em>(optional) <span style="color:green"><b>(new)</b></span></em> <b>xs_<em>&lt;fielddef_alias&gt;&gt;</em> = '<em>&lt;some search text&gt;</em>'</b>  - Search a particular field. You can use the <b>title</b>, the <b>alias</b> or a field definition alias, e.g.: <b>xs_title='an item title'</b>. It can be combined with fulltext search. Multiple xs_* parameters can be combined.</li>
  <li><em>(optional) <span style="color:green"><b>(new)</b></span></em> <b>xso_<em>&lt;fielddef_alias&gt;&gt;</em> = '='</b>  - same as <b>srchop</b> but exclusively for the extended search parameters: sets the way used in the query either as an exact search <b>'='</b> or as an approximate search <b>'LIKE'</b> which is the default mode. <sup><b><i>(1)</i></b></sup></li>
</ul>
<p>Aditionaly to the above parameters there a few more parameters that will enable you to filter by ranges in a number of ways. However using a range on a field precludes using a search or an extended search on that same field. You can however combine having some fields being filtered by range and others by extended search. Ranges are best used with numeric fields. Using them on mixed fields may have unpredictable results.</p>
<ul>
  <li><em>(optional) <span style="color:green"><b>(new)</b></span></em> <b>xsrstart_<em>&lt;fielddef_alias&gt;&gt;</em> = 10</b>  - range mode, better used with numeric values: sets the start of the range for the specified field. <sup><b><i>(2)(4)</i></b></sup></li>
  <li><em>(optional) <span style="color:green"><b>(new)</b></span></em> <b>xsrend_<em>&lt;fielddef_alias&gt;&gt;</em> = 150</b>  - range mode, better used with numeric values: sets the start of the range for the specified field. <sup><b><i>(2)(4)</i></b></sup></li>
  <li><em>(optional) <span style="color:green"><b>(new)</b></span></em> <b>xsio_<em>&lt;fielddef_alias&gt;&gt;</em> = o</b>  - range mode, determines if the range is filtered between, <b>(i)</b>nside, start and end values or <b>(o)</b>utside this values. Default is <b>(i)</b>nside. <sup><b><i>(3)(4)</i></b></sup></li>
  <li><em>(optional) <span style="color:green"><b>(new)</b></span></em> <b>xsrmode_<em>&lt;fielddef_alias&gt;&gt;</em> = exc</b>  - determines if the range is filtered <b>(inc)</b>luding start and end values or <b>(exc)</b>luding this values. Default is <b>(inc)</b>luding. <sup><b><i>(4)</i></b></sup></li>
</ul>

<p><b>Notes:</b></p>
<p><b>(1)</b> - won't affect search_* parameters which, if used will disable the xs_* parameters anyway.</p>
<p><b>(2)</b> - using range parameters on a field disables the extended search on that same field.</p>
<p><b>(3)</b> - <b>(o)</b>utside is basically equivalent to filtering to show all values NOT inside the start and end values.</p>
<p><b>(4)</b> - all the range parameters can be combined for the same field. and you can have multiple fields filtered by either extended search or range filtering. However using search_* on any of them disables the extended features.</p>