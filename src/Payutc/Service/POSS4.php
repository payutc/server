<?php

namespace Payutc\Service;

class POSS4 extends POSS3 {

    protected function shouldICheckUser() {
        return false;
    }

}