<?php
class Squad {
    protected $squadId;
    protected $squadName;
    protected $scrumMaster;

    public function __construct($squadId, $squadName, $scrumMaster) {
        $this->squadId = $squadId;
        $this->squadName = $squadName;
        $this->scrumMaster = $scrumMaster;
    }

}