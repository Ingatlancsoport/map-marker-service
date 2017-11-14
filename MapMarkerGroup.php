<?php

class MapMarkerGroup {
	private $center;
	private $markers = array();
	private $cardinality = 0;
	
	public function __construct($markers) {
		$this->addMarkers($markers);
	}
	
	/**
	 * @return GPSLocation
	 */
	public function getCenter() {
		return $this->center;
	}
	
	/**
	 * @return MapMarker
	 */
	public function getMarkers() {
		return $this->markers;
	}
	
	public function getCardinality() {
		return $this->cardinality;
	}
	
	public function addMarkers($markers) {
		$markers = is_array($markers)? $markers : array($markers);
		foreach ($markers as $marker) {
			if ($marker instanceof MapMarker) {
				$this->markers[] = $marker;
				$this->cardinality++;
			}
		}
		
		$this->center = $this->calculateCenter();
	}
	
	public function addMarker(MapMarker $marker) {
		$this->addMarkers($marker);
	}
	
	private function calculateCenter() {
		$cnt = count($this->markers);
		
		if ($cnt) {
			$lat = 0;
			$lon = 0;

			foreach ($this->markers as $marker) {
				$lat += $marker->getPosition()->lat();
				$lon += $marker->getPosition()->lon();
			}
			$center = new GPSLocation($lat / $cnt , $lon / $cnt);
		} else {
			$center = null;
		}
		
		return $center;
	}
}
