<?php
class ScrumMaster extends User {
    public function addSquad($squadId, $squadName) {
        $squad = new Squad($squadId, $squadName, $this);
        return $squad;
    }

    public function editSquad(Squad $squad, $newSquadName) {
        
    }

    public function deleteSquad(Squad $squad) {
        
    }

}