<?php

class CategoryTreeImageList
{
    /**
     * @var CategoryTreeImageList
     */
    static $instance = null;

    /**
     * @var array
     */
    protected $images;


    /**
     * CategoryTreeImage constructor.
     * @param Title $category
     * @throws MWException
     */
    public function __construct(Title $category){
        // Create request for getting image
        $request = new FauxRequest([
            'action' => 'ask',
            'query' => '[[Subcategory of::'.$category->getText().']]|?Main_Picture'
        ], false, null);

        $api = new ApiMain($request);
        $api->execute();

        // Get result data
        $data = $api->getResult()->getResultData(['query', 'results']);

        // Return formatted array
        $this->images = array_map([$this, 'formatDataRow'], $data);
    }

    /**
     * Reformat data
     *
     * @param $row
     * @return mixed
     */
    protected function formatDataRow($row){
        if(isset($row['printouts']['Main Picture'][0]))
            return $row['printouts']['Main Picture'][0];
        // Else return null
        return null;
    }

    /**
     * Return a unique instance of the CategoryTreeImage class
     *
     * @param Title $category
     * @return CategoryTreeImageList
     * @throws MWException
     */
    public static function fromCategory(Title $category){
        if(self::$instance === null){
            self::$instance = new CategoryTreeImageList($category);
        }
        return self::$instance;
    }

    /**
     * @param Title $title
     * @return mixed|null
     */
    public function getImage(Title $title){
        $titleText = $title->getFullText();

        // Return null if no image
        if(!isset($this->images[$titleText])) return null;

        $imageTitle = Title::makeTitleSafe(NS_FILE, $this->images[$titleText]);
        if(!$imageTitle instanceof Title) return null;

        $file = wfFindFile($imageTitle);
        // Return image if exists
        if($file !== false)
            return $file;
        // Else return null
        else
            return null;
    }

}