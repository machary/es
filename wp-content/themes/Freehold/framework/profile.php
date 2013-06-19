<?php
add_action('show_user_profile', 'wpsplash_extraProfileFields');
add_action('edit_user_profile', 'wpsplash_extraProfileFields');
add_action('personal_options_update', 'wpsplash_saveExtraProfileFields');
add_action('edit_user_profile_update', 'wpsplash_saveExtraProfileFields');

function wpsplash_saveExtraProfileFields($userID) {

	if (!current_user_can('edit_user', $userID)) {
		return false;
	}

	update_user_meta($userID, 'is_agent', $_POST['is_agent']);
	update_user_meta($userID, 'subtitle', $_POST['subtitle']);
	update_user_meta($userID, 'office', $_POST['office']);
	update_user_meta($userID, 'mobile', $_POST['mobile']);
	update_user_meta($userID, 'fax', $_POST['fax']);
	update_user_meta($userID, 'twitter', $_POST['twitter']);
	update_user_meta($userID, 'facebook', $_POST['facebook']);
	update_user_meta($userID, 'linkedin', $_POST['linkedin']);
	update_user_meta($userID, 'skype', $_POST['skype']);
}

function wpsplash_extraProfileFields($user)
{
?>
	<table class='form-table'>
		<tr>
			<th><label for='is_agent'>Is an agent?</label></th>
			<td>
				<select name="is_agent">
					<option value="yes" <?php if(get_the_author_meta('is_agent', $user->ID) == 'yes'): ?>selected="selected"<?php endif; ?>>Yes</option>
					<option value="no" <?php if(get_the_author_meta('is_agent', $user->ID) == 'no'): ?>selected="selected"<?php endif; ?>>No</option> 
				</select>
			</td>
		</tr>
		<tr>
			<th><label for='subtitle'>Subtitle</label></th>
			<td>
				<input type='text' name='subtitle' id='subtitle' value='<?php echo esc_attr(get_the_author_meta('subtitle', $user->ID)); ?>' class='regular-text' />
			</td>
		</tr>
		<tr>
			<th><label for='office'>Office</label></th>
			<td>
				<input type='text' name='office' id='office' value='<?php echo esc_attr(get_the_author_meta('office', $user->ID)); ?>' class='regular-text' />
			</td>
		</tr>
		<tr>
			<th><label for='mobile'>Mobile</label></th>
			<td>
				<input type='text' name='mobile' id='mobile' value='<?php echo esc_attr(get_the_author_meta('mobile', $user->ID)); ?>' class='regular-text' />
			</td>
		</tr>
		<tr>
			<th><label for='fax'>Fax</label></th>
			<td>
				<input type='text' name='fax' id='fax' value='<?php echo esc_attr(get_the_author_meta('fax', $user->ID)); ?>' class='regular-text' />
			</td>
		</tr>
	</table>

	<h3>Social Information</h3>

	<table class='form-table'>
		<tr>
			<th><label for='twitter'>Twitter Link</label></th>
			<td>
				<input type='text' name='twitter' id='twitter' value='<?php echo esc_attr(get_the_author_meta('twitter', $user->ID)); ?>' class='regular-text' />
			</td>
		</tr>
		<tr>
			<th><label for='facebook'>Facebook Link</label></th>
			<td>
				<input type='text' name='facebook' id='facebook' value='<?php echo esc_attr(get_the_author_meta('facebook', $user->ID)); ?>' class='regular-text' />
			</td>
		</tr>
		<tr>
			<th><label for='linkedin'>LinkedIn Link</label></th>
			<td>
				<input type='text' name='linkedin' id='linkedin' value='<?php echo esc_attr(get_the_author_meta('linkedin', $user->ID)); ?>' class='regular-text' />
			</td>
		</tr>
		<tr>
			<th><label for='skype'>Skype Link</label></th>
			<td>
				<input type='text' name='skype' id='skype' value='<?php echo esc_attr(get_the_author_meta('skype', $user->ID)); ?>' class='regular-text' />
			</td>
		</tr>
	</table>
<?php } ?>