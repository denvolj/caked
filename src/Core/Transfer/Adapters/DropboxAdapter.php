<?php

namespace CakeD\Core\Transfer\Adapters;
use Dropbox as dbx;
use CakeD\Core\Exceptions;
use Cake\Core\Configure;

/**
 * This adapter provides basic functionality to write files on dropbox servers
 * using their API.
 *
 * @author boecspecops
 */
class DropboxAdapter implements AdapterInterface {
    
    private $instance;
    private $config = null;
    
    public function __construct() {
        Configure::load('CakeD.config');
        $this->config = Configure::read('DROPBOX');
        
        if($this->config['token'] === null) {
            throw(new Exceptions\ConfigParamNotFound('Parameter token is null.'));
        }
        if($this->config['directory'] === null) {
            $this->config['directory'] = '';
        }
        if($this->config['mode'] === null) {
            $this->config['mode'] = 'rw';
        }
        
        $this->instance = $this->getClient();
    }
       
    public function getClient() {
        $client = new dbx\Client($this->config['token'], $this->config['directory']);
        
        return $client;
    }
    
    public function write($root, $localfile) {
        $f = fopen($root.$localfile, "rb");
        
        if(!$f) {
            throw(new Exceptions\FileNotFound("[DROPBOX] File \"$root$localfile\" not found."));
        }
        
        switch($this->config["mode"]) {
            case "rw": {
                $request = dbx\WriteMode::force();
                break;
            }
            case "a": {
                $request = dbx\WriteMode::add();
                break;
            }
        }
        
        try{
            $this->instance->uploadFile($this->config['directory'].$localfile, $request, $f);
        }
        catch(dbx\Exception_NetworkIO $e) {
            throw(new Exceptions\ConnectionReset($e->getMessage()));
        } 
        finally {
            fclose($f);
        }
    }
    
    public function is_dir($path) {
        
    }
    
    public function dir_exists($path) {
        
    }
}
