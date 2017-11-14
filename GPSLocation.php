<?php

class GPSLocation {

    const DEFAULT_CENTER_LATITUDE = 0;
    const DEFAULT_CENTER_LONGITUDE = 0;
    
    private $lat;
    private $lon;

    /**
     * Konstruktor
     * @param float $lat
     * @param float $lon 
     */
    public function __construct($lat=null, $lon=null) {
        $this->lat = isset($lat) ? $lat : self::DEFAULT_CENTER_LATITUDE;
        $this->lon = isset($lon) ? $lon : self::DEFAULT_CENTER_LONGITUDE;
    }

    public function lat() {
        return $this->lat;
    }

    public function lon() {
        return $this->lon;
    }

    public function setLat($value) {
        $this->lat = $value;
    }

    public function setLon($value) {
        $this->lon = $value;
    }

    /**
     * Kiszámolja egy másik GPS koordinátától km-ben számított távolságot.
     * @param GPSLocation $gps_location
     * @return float 
     */
    public function distanceTo(GPSLocation $gps_location) {
        $r = 6371; // km
        $d_lat = deg2rad($gps_location->lat() - $this->lat);
        $d_lon = deg2rad($gps_location->lon() - $this->lon);
        $lat1 = deg2rad($this->lat);
        $lat2 = deg2rad($gps_location->lat());
        $a = sin($d_lat / 2) * sin($d_lat / 2) + sin($d_lon / 2) * sin($d_lon / 2) * cos($lat1) * cos($lat2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $r * $c;
    }
	
	// csak kis távolságokra (<10km) pontos
	public function changePositionInMeter($dx, $dy) {
		$lat = $this->lat + (180 / pi()) * ($dy / 6378137);
		$this->lon = $this->lon + (180 / pi()) * ($dx / 6378137) / cos($this->lat);
		$this->lat = $lat;
	}
	
}

?>
