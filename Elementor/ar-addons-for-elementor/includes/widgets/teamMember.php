<?php
namespace Pluginever\EverAddons\Widgets;


use Elementor\Controls_Manager as Controls_Manager;
use Elementor\Widget_Base;

class TeamMember extends Widget_Base{
	public function get_name() {
		return 'ever-addons-team-member';
	}

	public function get_title() {
		return esc_html__( 'Team Member', 'ever-addons-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-person';
	}

	public function get_categories() {
		return [ 'ever-addons' ];
	}


	protected function _register_controls() {
		$this->start_controls_section(
			'section_team_member_image',
			[
				'label' => __( 'Member Image', 'ever-addons-for-elementor' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_team_member_details',
			[
				'label' => __( 'Member Details', 'ever-addons-for-elementor' ),
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_team_member_socials_links',
			[
				'label' => __( 'Social Links', 'ever-addons-for-elementor' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_team_member_styles',
			[
				'label' => esc_html__( 'Team Member Styles', 'ever-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
	}
}
