<?php

/**
* Custom Post Type UI Admin UI
*/
class cptui_admin_ui {

	function __construct() {

	}

	public function tr_start() {
		return '<tr valign="top">';
	}

	public function tr_end() {
		return '</tr>';
	}

	public function th_start() {
		return '<th scope="row">';
	}

	public function th_end() {
		return '</th>';
	}

	public function td_start() {
		return '<td>';
	}

	public function td_end() {
		return '</td>';
	}

	public function label( $label_for, $label_text ) {
		$label = '<label for="' . $label_for . '"> ' . $label_text . '</label>';

		return $label;
	}

	public function required() {
		return '<span class="required">*</span>';
	}

	public function help( $help_text ) {
		return '<a href="#" title="' . $help_text . '" class="help">?</a>';
	}

	/**
	 * Display a select input with true/false values.
	 * @param  array  $args values to use in the input
	 * @return string       constructed input for the form.
	 */
	public function select_bool_input( $args = '' ) {
		$defaults = array(

		);
		$args = wp_parse_args( $args, $defaults );

		$value = $this->tr_wrap_start('','');
		$value .= '<select name="' . $args['name'] . '">';

		foreach( $args['values'] as $val ) {
			$value .= '<option value="' . $val['value_int'] . '" ' . selected( $args['selected'], $val['value_int'] ) . '>' . $val['value_string'] . '</option>';
		}
		$value .= '</select>' . $args['help_text'];

		$value .= $this->tr_wrap_end();

		return $value;
	}

	/**
	 * Display a text input for the user. Will populate if data is available from options
	 * @param  array  $args values to use in the input
	 * @return string       constructed input for the form.
	 */
	public function text_input( $args = '' ) { //TODO: Finish output of other attributes
		$defaults = $this->default_input_parameters(
			array(
				'maxlength'     => '',
				'onblur'        => '',
			)
		);
		$args = wp_parse_args( $args, $defaults );

		if ( $args['wrap'] ) {
			$value = $this->tr_start();
			$value .= $this->th_start();
			$value .= $this->label( $args['name'], $args['labeltext'] );
			$value .= $this->required( $args['required'] );
			$value .= $this->help( $args['helptext'] );
			$value .= $this->th_end();
			$value .= $this->td_start();
		}

		$value .= '<input type="text" id="' . $args['name'] . '" name="' . $args['namearray'] . '[' . $args['name'] . ']" value="' . $args['textvalue'] . '" /><br/>';

		if ( !empty( $args['aftertext'] ) )
			$value .= $args['aftertext'];

		if ( $wrap ) {
			$value .= $this->td_end();
			$value .= $this->tr_end();
		}

		return $value;
	}

	/**
	 * Display a textarea input for the user. Will populate if data is available from options
	 * @param  array  $args values to use in the input
	 * @return string       constructed input for the form.
	 */
	public function textarea_input( $args = '' ) {
		$defaults = $this->default_input_parameters(
			array(
				'rows' => '',
				'cols' => '',
			)
		);
		$args = wp_parse_args( $args, $defaults );

		if ( $args['wrap'] ) {
			$value = $this->tr_start();
			$value .= $this->th_start();
			$value .= $this->label( $args['name'], $args['labeltext'] );
			$value .= $this->help( $args['helptext'] );
			$value .= $this->th_end();
			$value .= $this->td_start();
		}

		$value .= '<textarea id="' . $args['name'] . '" name="' . $args['namearray'] . '[' . $args['name'] . ']" rows="' . $args['rows'] . '" cols="' . $args['cols'] . '">' . $args['textvalue'] . '</textarea>';

		if ( !empty ( $args['aftertext'] ) )
			$value .= $args['aftertext'];

		if ( $wrap ) {
			$value .= $this->td_end();
			$value .= $this->tr_end();
		}

		return $value;
	}

	/**
	 * Display a checkbox input for the user. Will check the already selected options if data is available from options.
	 * @param  array  $args values to use in the input
	 * @return string       constructed input for the form
	 */
	public function check_input( $args = '' ) {
		$defaults = $this->default_input_parameters(
			array(
				'checkvalue'    => '',
				'checked'       => true,
				'checklisttext' => '',
			)
		);
		$args = wp_parse_args( $args, $defaults );
		extract( $args );

		$value = $this->tr_start();
		$value .= $this->th_start();
		$value .= $checklisttext;
		$value .= $this->th_end();
		$value .= $this->td_start();


		$value .= '<input type="checkbox" name="' . $namearray . '[]" value="' . $checkvalue . '"' . checked( $checked, true, false) . ' />';
		$value .= $value .= $this->label( $name, $labeltext );
		$value .= $this->help( $helptext );

		$value .= $this->tr_end();

		return $value;


		/*
		 p;<?php _e( 'Title' , 'cpt-plugin' ); ?> <a href="#" title="<?php esc_attr_e( 'Adds the title meta box when creating content for this custom post type', 'cpt-plugin' ); ?>" class="help">?</a>
		 */
	}

	/**
	 * Return an array of default input values that all input types have.
	 *
	 * @return array  array of defaults.
	 */
	public function default_input_parameters( $additions = array() ) {
		return array_merge(
			array(
				'namearray'     => '',
				'name'          => '',
				'textvalue'     => '',
				'labeltext'     => '',
				'aftertext'     => '',
				'helptext'      => '',
				'required'      => false,
				'wrap'          => true
			),
			(array)$additions
		);
	}
}
