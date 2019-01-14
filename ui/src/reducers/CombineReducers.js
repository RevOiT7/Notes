import {combineReducers} from 'redux';
import CreateBar from './CreateBar'
import folderContainer from './FolderContainer'

const allReducers = combineReducers({
     window: CreateBar,
     folderContainer: folderContainer
});

export default allReducers;