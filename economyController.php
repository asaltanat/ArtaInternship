  public function economy(UserSynergy $userSynergy)
    {
        $industries = [];
        $names = [];
        foreach ($userSynergy->getRegistryFullData('otraslevaya_ekonomika_') as $data) {
            if (empty($names[$data['industry-ru-value']->value])) {
                $name = $data['industry-kk-value']->value;
                switch (app()->getLocale()) {
                    case 'ru':
                    if (isset($data['industry-ru-value']->value) and
                      $data['industry-ru-value']->value != '' )
                    {
                        $name = $data['industry-ru-value']->value;
                    }
                    break;
                    case 'en':
                    if (isset($data['industry-en-value']->value) and
                      $data['industry-en-value']->value != '') 
                    {
                        $name = $data['industry-en-value']->value;
                    }
                    break;
                    case 'kz':
                    if (isset($data['industry-kk-value']->value) and
                      $data['industry-kk-value']->value != '') 
                    {
                        $name = $data['industry-kk-value']->value;
                    }
                    break;
                    default:
                    break;
                }
                    $names[$data['industry-ru-value']->value] = $name;
            }
            $industries[$data['industry-ru-value']->value]['name'] = isset($names[$data['industry-ru-value']->value]) ? $names[$data['industry-ru-value']->value] : $data['industry-ru-value']->value;
        }
        foreach ($userSynergy->getRegistryFullData('shablony_biznes-planov') as $data) {
        
            $docValue = $data['name-kk-value']->value;
            if (
                isset($data['name-' . app()->getLocale() . '-value']->value) and
                $data['name-' . app()->getLocale() . '-value']->value != ''
            ) {
                $docValue = $data['name-' . app()->getLocale() . '-value']->value;
            }
            $fileValue = $data['file-kk-value']->key;
            if (
                isset($data['file-' . app()->getLocale() . '-value']->key) and
                $data['file-' . app()->getLocale() . '-value']->key != ''
            ) {
                $fileValue = $data['file-' . app()->getLocale() . '-value']->key;
            }
            $template = [
                'uuid' => $data['uuid'],
                'template' => $docValue,
                'file'=>"http://109.233.109.199:8080/Synergy/resource_downloader?identifier=" .nl2br($fileValue)."&format=pdf",
            ];
            $industries[$data['industry-value']->value]['templates'][] = $template;
        }
       
        return view('economy', [
            'industries' => $industries,
        ]);

    }
