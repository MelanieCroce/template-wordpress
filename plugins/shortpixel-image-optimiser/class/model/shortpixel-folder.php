<?php

class ShortPixelFolder extends ShortPixelEntity{
    const META_VERSION = 1;
    
    protected $id;
    protected $path;
    protected $type;
    protected $status;
    protected $fileCount;
    protected $tsCreated;
    protected $tsUpdated;
    
    const TABLE_SUFFIX = 'folders';
    
    public function __construct($data) {
        parent::__construct($data);
    }
    
    public static function checkFolder($folder, $base) {
        if(substr($folder, 0, 1) !== '/') {
            $folder = '/' . $folder;
        }
        if(is_dir($folder)) {
            return realpath($folder);
        } elseif(is_dir($base . $folder)) {            
            return realpath($base . $folder);
        }
        return false;
    }
    
    /**
     * returns the first from parents that is a parent folder of $folder
     * @param type $folder
     * @param type $parents
     * @return parent if found, false otherwise
     */
    public static function checkFolderIsSubfolder($folder, $parents) {
        if(!is_array($parents)) {
            $parents = array($parents);
        }
        foreach($parents as $parent) {
            if(strpos($folder, $parent) === 0 && (strlen($parent) == strlen($folder) || substr($folder, strlen($parent), 1) == '/')) {
                return $parent;
            }
        }
        return false;
    }
    
    /**
     * finds the first from the subfolders that has the folder as parent
     * @param type $folder
     * @param type $subfolders
     * @return subfolder if found, false otherwise
     */
    public static function checkFolderIsParent($folder, $subfolders) {
        if(!is_array($subfolders)) {
            $subfolders[] = $subfolders;
        }
        foreach($subfolders as $sub) {
            if(strpos($sub, $folder) === 0 && (strlen($folder) == strlen($sub) || substr($sub, strlen($folder) - 1, 1) == '/')) {
                return $sub;
            }
        }
        return false;
    }

    public function countFiles($path = null) {
        $size = 0;
        $path = $path ? $path : $this->getPath();
        if($path == null) {
            return 0;
        }
        $ignore = array('.','..');
        if(!is_writable($path)) {
            throw new SpFileRightsException("Folder " . $path . " is not writeable. Please check permissions and try again.");
        }
        $files = scandir($path);
        foreach($files as $t) {
            $tpath = rtrim($path, '/') . '/' . $t;
            if(in_array($t, $ignore)) continue;
            if (is_dir($tpath)) {
                $size += $this->countFiles($tpath);
            } elseif(in_array(pathinfo($t, PATHINFO_EXTENSION), WPShortPixel::$PROCESSABLE_EXTENSIONS)) {
                $size++;
            }   
        }
        return $size;
    }    
    
    public function getFileList($onlyNewerThan = 0) {
        $upl = wp_upload_dir();
        $fileListPath = tempnam($upl["basedir"] . '/', 'sp_');
        $fileHandle = fopen($fileListPath, 'w+');
        self::getFileListRecursive($this->getPath(), $fileHandle, $onlyNewerThan);
        fclose($fileHandle);
        return $fileListPath;
    }
    
    protected static function getFileListRecursive($path, $fileHandle, $onlyNewerThan) {
        $ignore = array('.','..');
        $files = scandir($path);
        $add = (filemtime($path) > $onlyNewerThan);
        /*
        if($add && $onlyNewerThan) {
            echo("<br> FOLDER UPDATED: " . $path);            
        }
        */
        foreach($files as $t) {
            if(in_array($t, $ignore)) continue;
            $tpath = trailingslashit($path) . $t;
            if (is_dir($tpath)) {
                self::getFileListRecursive($tpath, $fileHandle, $onlyNewerThan);
            } elseif($add && in_array(pathinfo($t, PATHINFO_EXTENSION), WPShortPixel::$PROCESSABLE_EXTENSIONS)) {
                fwrite($fileHandle, $tpath . "\n");
            }   
        }
    }
    
    public function checkFolderContents($callback) {
        $changed = array();
        self::checkFolderContentsRecursive($this->getPath(), $changed, $callback);
        return $changed;
    }
    
    protected static function checkFolderContentsRecursive($path, &$changed, $callback) {
        $ignore = array('.','..');
        $files = scandir($path);
        $reference = call_user_func_array($callback, array($path));
        foreach($files as $t) {
            if(in_array($t, $ignore)) continue;
            $tpath = trailingslashit($path) . $t;
            if (is_dir($tpath)) {
                self::checkFolderContentsRecursive($tpath, $callback);
            } elseif(   in_array(pathinfo($t, PATHINFO_EXTENSION), WPShortPixel::$PROCESSABLE_EXTENSIONS)
                     && !(in_array($tpath, $reference) && $reference[$tpath]->compressedSize == filesize($tpath))) {
                $changed[] = $tpath;
            }   
        }
    }
    
    public function getFolderContentsChangeDate() {
        return self::getFolderContentsChangeDateRecursive($this->getPath(), 0, time($this->getTsUpdated()));
    }
    
    protected static function getFolderContentsChangeDateRecursive($path, $mtime, $refMtime) {
        $ignore = array('.','..');
        if(!is_writable($path)) {
            throw new SpFileRightsException("Folder " . $path . " is not writeable. Please check permissions and try again.");
        }
        $files = scandir($path);
        $mtime = max($mtime, filemtime($path));
        foreach($files as $t) {
            if(in_array($t, $ignore)) continue;
            $tpath = rtrim($path, '/') . '/' . $t;
            if (is_dir($tpath)) {
                $mtime = max($mtime, filemtime($tpath));
                self::getFolderContentsChangeDateRecursive($tpath, $mtime, $refMtime);
            }   
        }
        return $mtime;
    }    
    
    function getId() {
        return $this->id;
    }

    function getPath() {
        return $this->path;
    }

    function getTsCreated() {
        return $this->tsCreated;
    }

    function getTsUpdated() {
        return $this->tsUpdated;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPath($path) {
        $this->path = $path;
    }

    function getType() {
        return $this->type;
    }

    function setType($type) {
        $this->type = $type;
    }

    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function getFileCount() {
        return $this->fileCount;
    }

    function setFileCount($fileCount) {
        $this->fileCount = $fileCount;
    }

    function setTsCreated($tsCreated) {
        $this->tsCreated = $tsCreated;
    }

    function setTsUpdated($tsUpdated) {
        $this->tsUpdated = $tsUpdated;
    }
    
    /**
     * needed as callback
     * @param type $item
     */
    public static function path($item) {
        return $item->getPath();
    }

}
