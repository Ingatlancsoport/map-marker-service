<?php

class MapMarker {
	private $position;
	private $data = array();
	
	public function __construct(GPSLocation $position) {
		$this->position = $position;
	}
	
	/**
	 * @return GPSLocation
	 */
	public function getPosition() {
		return $this->position;
	}
	
	public function getData($key, $default=null) {
		return isset($this->data[$key]) ? $this->data[$key] : $default;
	}
	
	public function setPosition(GPSLocation $position) {
		$this->position = $position;
	}
	
	public function setData($key, $value) {
		$this->data[$key] = $value;
	}
}
