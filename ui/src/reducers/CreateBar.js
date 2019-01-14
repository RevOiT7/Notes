import {
    ACTION_RECEIVE_NAME_FOLDER,
    ACTION_OPEN_WINDOW_TO_CREATE,
    ACTION_CLOSED_WINDOW,
    ACTION_RECEIVE_CAPTION_NOTE
} from "../constants/constants";
    import {createRef} from "react";

const initialState = {
    windowForCreating: 0,
    title: '',
    parent_id: 0,
    httpMethod: 'POST',
    url: 'api/auth/folder/{id}',
    caption: '',
    text: createRef()
};

 const createFolderNoteReducer = (state = initialState, action) => {
    switch (action.type) {
        case ACTION_RECEIVE_NAME_FOLDER:
            return {...state, title: action.payload};
        case ACTION_RECEIVE_CAPTION_NOTE:
            return {...state, caption: action.payload};
        case ACTION_OPEN_WINDOW_TO_CREATE:
            return {...state, windowForCreating: action.payload};
        case ACTION_CLOSED_WINDOW:
            return {...state, windowForCreating: action.payload};
        default:
            return state
    }
};

export default createFolderNoteReducer;