FormElementInterface [BelongsToForm, HasParent, Renderable]

- abstract Field [+ HasOptions, HasAttributes, HasTitle, HasName, HasValue, HasValueValidation]

- abstract Button [+ HasAttributes, HasTitle]

- ElementsCollection [TypedCollection<FormElementInterface>]

    - abstract ElementSet [+ HasName, HasValue, HasValueValidation]

- abstract ElementsGroup [Std, HasSchema + HasName, HasValue, HasValueValidation]

    - Form [+ HasAttributes]