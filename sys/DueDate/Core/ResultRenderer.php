<?php

namespace DueDate\Core;

/**
 * Description of ResultRenderer
 */
class ResultRenderer
{
    protected $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    /**
     * @desc -  display the result correctly
     */
    public function renderResult()
    {
        echo '<pre>';
        $this->show();
        echo '</pre>';
    }

    /**
     * @desc show just the result
     * @throws Exception
     */
    protected function show()
    {
        if (!empty($this->result))
        {
            if (is_array($this->result))
            {
                foreach ($this->result as $result)
                {
                    print_r($result);
                }
            }
            else
            {
                print_r($this->result);
            }
        }
        else
        {
            throw new Exception('Can not render epmpty result!');
        }
    }
}
