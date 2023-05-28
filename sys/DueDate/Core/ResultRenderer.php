<?php

namespace DueDate\Core;

/**
 * Description of ResultRenderer
 *
 * @author Csaba Barnabas Barcsa
 */
class ResultRenderer
{
    protected $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function renderResult()
    {
        echo '<pre>';
        $this->show();
        echo '</pre>';
    }

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
