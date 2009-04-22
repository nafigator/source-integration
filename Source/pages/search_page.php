<?php
# Copyright (C) 2008-2009 John Reese, LeetCode.net
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU Affero General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU Affero General Public License for more details.

access_ensure_global_level( plugin_config_get( 'view_threshold' ) );

require_once( config_get( 'plugin_path' ) . 'Source' . DIRECTORY_SEPARATOR . 'Source.FilterAPI.php' );

list( $t_filter, $t_permalink ) = Source_Generate_Filter();

$t_date_start = ( is_null( $t_filter->filters['date_start']->value ) ? 'start' : $t_filter->filters['date_start']->value );
$t_date_end = ( is_null( $t_filter->filters['date_end']->value ) ? 'now' : $t_filter->filters['date_end']->value );

html_page_top1( plugin_lang_get( 'title' ) );
html_page_top2();

?>

<br/>
<form action="<?php echo helper_mantis_url( 'plugin.php' ) ?>" method="get">
<input type="hidden" name="page" value="Source/search"/>
<table class="width75" align="center" cellspacing="1">

<tr>
<td class="form-title" colspan="2"><?php echo plugin_lang_get( 'search' ), ' ', plugin_lang_get( 'changesets' ) ?></td>
<td class="right" colspan="5">
<?php
print_bracket_link( plugin_page( 'search_page' ), plugin_lang_get( 'new_search' ) );
print_bracket_link( plugin_page( 'index' ), plugin_lang_get( 'back' ) );
?>
</tr>

<tr class="row-category">
<td><?php echo plugin_lang_get( 'type' ) ?></td>
<td><?php echo plugin_lang_get( 'repository' ) ?></td>
<td><?php echo plugin_lang_get( 'branch' ) ?></td>
<td><?php echo plugin_lang_get( 'action' ) ?></td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
<td class="center"><?php Source_Type_Select( $t_filter->filters['r.type']->value ) ?></td>
<td class="center"><?php Source_Repo_Select( $t_filter->filters['r.id']->value ) ?></td>
<td class="center"><?php Source_Branch_Select( $t_filter->filters['c.branch']->value ) ?></td>
<td class="center"><?php Source_Action_Select( $t_filter->filters['f.action']->value ) ?></td>
</tr>

<tr class="spacer"><td></td></tr>

<tr class="row-category">
<td><?php echo plugin_lang_get( 'username' ) ?></td>
<td><?php echo plugin_lang_get( 'author' ) ?></td>
<td><?php echo plugin_lang_get( 'revision' ) ?></td>
<td><?php echo plugin_lang_get( 'issue' ) ?></td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
<td class="center"><?php Source_Username_Select( $t_filter->filters['c.user_id']->value ) ?></td>
<td class="center"><?php Source_Author_Select( $t_filter->filters['c.author']->value ) ?></td>
<td class="center"><input name="revision" size="10" value="<?php echo string_attribute( $t_filter->filters['f.revision']->value ) ?>"/></td>
<td class="center"><input name="bug_id" size="10" value="<?php echo string_attribute( join( ',', $t_filter->filters['b.bug_id']->value ) ) ?>"/></td>
</tr>

<tr class="spacer"><td></td></tr>

<tr <?php echo helper_alternate_class() ?>>
<td class="category">Beginning Date</td>
<td colspan="3"><?php Source_Date_Select( 'date_start', $t_date_start ); ?></td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
<td class="category">Ending Date</td>
<td colspan="3"><?php Source_Date_Select( 'date_end', $t_date_end ); ?></td>
</tr>

<tr class="spacer"><td></td></tr>

<tr <?php echo helper_alternate_class() ?>>
<td class="category"><?php echo plugin_lang_get( 'message' ) ?></td>
<td colspan="6"><input name="message" size="40" value="<?php echo string_attribute( $t_filter->filters['c.message']->value ) ?>"/></td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
<td class="category"><?php echo plugin_lang_get( 'filename' ) ?></td>
<td colspan="6"><input name="filename" size="40" value="<?php echo string_attribute( $t_filter->filters['f.filename']->value ) ?>"/></td>
</tr>

<tr>
<td class="center" colspan="7"><input type="submit" value="<?php echo plugin_lang_get( 'search' ) ?>"/></td>
</tr>

</table>
</form>

<?php
html_page_bottom1( __FILE__ );

