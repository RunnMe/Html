FormElementInterface [BelongsToForm, HasParent, Renderable]

- abstract Field [+ HasOptions, HasAttributes, HasTitle, HasName, HasValue]

- abstract Button [+ HasAttributes, HasTitle]

- ElementsCollection [TypedCollection<FormElementInterface>]

    - abstract ElementSet [+ HasName, HasValue]

- abstract ElementsGroup [Std, HasSchema + HasName, HasValue]

    - Form [+ HasAttributes]