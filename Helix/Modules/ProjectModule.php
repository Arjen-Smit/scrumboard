<?php

namespace Helix\Modules;

use ScrumBoard\ProjectPeer;
use ScrumBoard\ProjectQuery;
use ScrumBoard\Project;

class ProjectModule extends ApiModule {
    
    protected $project;
    
    protected $id;
        
    /**
     * Sets the $id
     * 
     * @param integer $id
     */
    public function SetId($id) {
        $this->id = (int) $id;
    }
        
    public function ApiGet() {
        if (isset($this->id)) {
            $project = ProjectPeer::retrieveByPK($this->id);
            if ($project instanceof Project) {
                $this->project = $project;
                $this->ProjectDetail();
            }
        }
        else {
            $this->AvailableProjectList();
        }
    }
    
    public function ApiPost() {
        return json_encode(array("error" => "not yet implemented"));
    }
    
    protected function AvailableProjectList() {        
        foreach (ProjectQuery::create()->find() as $project) {
            if ($project instanceof Project) {
                array_push($this->content, $project->toArray());
            }
        }
    }
    
    protected function ProjectDetail() {
        $output = array();
        $output['Tabs'] = $this->GetProjectTabs();
        $output['Stories'] = $this->GetProjectNotes();
        array_push($this->content, $output);
    }
    
    protected function GetProjectTabs() {
        $tabs = array();
        foreach ($this->project->getProjectTabs() as $tab) {
            array_push($tabs, $tab->toArray() );
        }
        
        return $tabs;
    }
    
    protected function GetProjectNotes() {
        $stories = array();
        foreach ($this->project->getProjectStorys() as $story) {
            array_push($stories, $story->toArray() );
        }
        return $stories;
    }
    
}