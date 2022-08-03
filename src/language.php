<?php

namespace language;

use language\languageInterface;

final class language implements languageInterface
{

    protected $languages = array();
    protected $defaultLanguage = 'pt-br';
        
    /**
     * Evento construtor da classe
     *
     * @param  array $languages
     * @return void
     */
    public function __construct(array $languages)
    {
        if(isset($languages) && !empty($languages)){
            foreach($languages as $language){
                $this->new($language['local'], $language['language']);
            }
        }
    }
    
    /**
     * Adiciona novo local de etiquetas para a linguagem
     *
     * @param  string $local
     * @param  string $language
     * @return bool
     */
    public function new(string $local, string $language = 'pt-br')
    {
        if(isset($local) && !empty($local)){
            if(!file_exists($local)){ return false;}
            $this->setlanguages( $local, $language);
            return true;
        }

        return false;
    }
    
    /**
     * Expõe os valores para a etiqueta
     *
     * @param  mixed $label
     * @return void
     */
    public function get(string $label)
    {
        $valueLabel = array();
        $languages = $this->getLanguages()[$this->getDefaultLanguage()];
        foreach($languages as $language){
            $labels = include($language);
            if(isset($labels[$label]) && !empty($labels[$label])){
                $valueLabel[] = $labels[$label];
            }
        }

        return implode(' ', $valueLabel);
    }

    /**
     * Get the value of languages
     */ 
    public function getLanguages()
    {
        return $this->languages;
    }
         
    /**
     * Set the value of languages
     *
     * @param  mixed $local
     * @param  mixed $language
     * @return self
     */
    public function setLanguages(string $local, string $language = 'pt-br')
    {
        if(isset($local) && !empty($local)){
            $this->languages[$language][] = $local;
        }

        return $this;
    }

    /**
     * Get the value of defaultLanguage
     */ 
    public function getDefaultLanguage()
    {
        return $this->defaultLanguage;
    }

    /**
     * Set the value of defaultLanguage
     *
     * @return  self
     */ 
    public function setDefaultLanguage($defaultLanguage)
    {
        if(isset($defaultLanguage) && !empty($defaultLanguage)){
            $this->defaultLanguage = $defaultLanguage;
        }

        return $this;
    }
}
?>