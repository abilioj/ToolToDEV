<?php

namespace abilioj\ToolToDev\util;

/*
 * class de cria e deleta diretório 
 */

/**
 * Description of Dir_File
 *
 * @author Abílio José G Ferreira
 */
class Dir_File {
    

    private function ScanDir($dir) {
        $arrfiles = array();
        if (is_dir($dir)) {
            if ($handle = opendir($dir)) {
                chdir($dir);
                while (false !== ($file = readdir($handle))) {
                    if ($file != "." && $file != "..") {
                        $arrfiles[] = $dir . "/" . $file;
                    }
                }
                chdir("../");
            }
            closedir($handle);
        }
        return $arrfiles;
    }

    public function CriaDiretorio($dir) {
        if (!file_exists($dir)):
            return mkdir($dir);
        else:
            return TRUE;
        endif;
    }

    public function DelDiretorio($dir) {
        if (!file_exists($dir)):
            if ($ListDir != null):
                return rmdir($dir);
            else:
                return FALSE;
            endif;
        else:
            return FALSE;
        endif;
    }

    /**
     * Fun o para deletar um diret rio e todos os seus arquivos e subdiret rios
     * @param string $dir Diret rio a ser deletado
     * @param boolean $DeleteMe Se for TRUE, deleta o pr prio diret rio tamb m
     * @return boolean Retorna TRUE em caso de sucesso, FALSE em caso de erro
     */
    public function DelDiretorioArvore($dir,$DeleteMe) {      
        if ($DeleteMe==NULL)$DeleteMe=FALSE;
        if (!$dh = @opendir($dir))return FALSE;
        while (false !== ($obj = readdir($dh))) {
            if ($obj == '.' || $obj == '..')
                continue;
            if (!@unlink($dir . '/' . $obj)) {
                if (!$this->DelDiretorioArvore($dir . '/' . $obj, true)) {
                    return FALSE;
                }
            }
        }
        
        closedir($dh);
        if ($DeleteMe) {
            return rmdir($dir);
        }  else {
            return TRUE;
        }
    }

    public function RenomeaDiretorio($dir, $newdir) {
        return rename($dir, $newdir);
    }

    public function ScanDiretorio($dir) {
        $arrfiles = array();
        if (is_dir($dir)) {
            if ($handle = opendir($dir)) {
                chdir($dir);
                while (false !== ($file = readdir($handle))) {
                    if ($file != "." && $file != "..") {
                        if (is_dir($file)) {
                            $arr = $this->ScanDir($file);
                            foreach ($arr as $value) {
                                $arrfiles[] = $dir . "/" . $value;
                            }
                        } else {
                            $arrfiles[] = $dir . "/" . $file;
                        }
                    }
                }
                chdir("../");
            }
            closedir($handle);
        }
        return $arrfiles;
    }

    public function DelFile($paramDir,$paramFil) {
        $dir = ($paramDir == null || $paramDir =="") ? __DIR__ : $paramDir;
        $fil = ($paramFil == null || $paramFil =="") ? '*.log' : $paramFil;
        array_map('unlink', glob($dir . "/" . $fil));
    }
    
}