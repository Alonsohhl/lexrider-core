<?php

/**
 * CMB textarea_code field type
 *
 * @since  2.2.2
 *
 * @category  WordPress_Plugin
 * @package   CMB2
 * @author    CMB2 team
 * @license   GPL-2.0+
 * @link      https://cmb2.io
 */
class CMB2_Type_Textarea_Code extends CMB2_Type_Textarea {

	/**
	 * Handles outputting an 'textarea' element
	 *
	 * @since  1.1.0
	 *
	 * @param  array $args Override arguments
	 *
	 * @return string       Form textarea element
	 */
	public function render( $args = array() ) {
		return $this->rendered(
			sprintf( '<pre>%s', parent::render( array(
				'class' => 'cmb2-textarea-code',
				'desc'  => '</pre>' . $this->_desc( true ),
			) ) )
		);
	}
}
