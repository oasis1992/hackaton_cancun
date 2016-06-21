using UnityEngine;
using System.Collections;
using System.Collections.Generic;
using System.Linq;
using UnityEngine.UI;
using Parse;

public class SentencesController : MonoBehaviour
{
	public Text senteceView;
	public OptionsController options;
	public GameObject finalPanel;

	private string currentSentence;
	private string[] sentences;
	private List<ParseObject> scoreList,score2List;
	private int currentIndex;
	private int correctAnswer;
	private int score;
	// Use this for initialization

	void Start ()
	{
		finalPanel.SetActive (false);
		currentIndex = 0;
		score = 0;
		correctAnswer = -1;
		StartCoroutine (getSentences2FromServer ());
		/*
		ParseObject psentence = new ParseObject("Test");
		psentence["text"] = "When i see someone screaming to my friend, i feel #.";
		psentence ["afraid"] = true;
		psentence ["happy"] = true;
		psentence ["angry"] = true;
		psentence ["disgusted"] = true;
		psentence ["sad"] = true;
		psentence ["correct_answer"] = 1;
		psentence.SaveAsync();
		*/
	}

	IEnumerator getSentencesFromServer() {

		var query = ParseObject.GetQuery("Sentences").Limit(5);
		var queryTask = query.FindAsync();
		while (!queryTask.IsCompleted) yield return null;

		if (queryTask.IsFaulted || queryTask.IsCanceled) {
			Debug.Log ("error de conexion");
		} else {
			scoreList = new List<ParseObject>  ();
			scoreList = queryTask.Result.ToList();
			loadNextSentence ();
		}
	}

	IEnumerator getSentences2FromServer() {

		var query = ParseObject.GetQuery("Sentences2").Limit(5);
		var queryTask = query.FindAsync();
		while (!queryTask.IsCompleted) yield return null;

		if (queryTask.IsFaulted || queryTask.IsCanceled) {
			Debug.Log ("error de conexion");
		} else {
			score2List = new List<ParseObject>  ();
			score2List = queryTask.Result.ToList();
			loadNext ();
			for (int i = 0; i < score2List.Count; i++) {
				ParseObject result = score2List.ElementAt (i);
				IList<object> optionsList = result.Get<List<object>>("responses");
				for (int j = 0; j < optionsList.Count; j++) {
					IDictionary<string, object> dictionary = (IDictionary<string, object>)optionsList.ElementAt (j);
				}
			}
		}
	}

	public void loadNextSentence(){
		if (currentIndex < scoreList.Count) {
			ParseObject result = scoreList.ElementAt (currentIndex);
			string sentence = (string)result ["text"];
			correctAnswer = result.Get<int> ("correct_answer");
			currentSentence = sentence;
			string[] sentenceTokens = currentSentence.Split ('#');
			senteceView.text = sentenceTokens [0] + " _______________ " + sentenceTokens [1];
			options.showAvailableOptions (result);
			currentIndex++;
		} else {
			ParseObject kidTest = new ParseObject("Test");
			kidTest["score"] = score;
			kidTest.SaveAsync();
			senteceView.text = "End of the test";


		}
	}

	public void updateSentence(string answer){
		string[] sentenceTokens = currentSentence.Split ('#');
		senteceView.text = sentenceTokens [0] + " "+answer+" " + sentenceTokens [1];
	}

	public void checkSelectedOption(){
		if (options.selectedOption == correctAnswer) {
			score++;
		}
		Debug.Log ("selected : " + options.selectedOption + " correct: " + correctAnswer);
		loadNext ();
	}

	public void loadNext(){
		if (currentIndex < score2List.Count) {
			ParseObject result = score2List.ElementAt (currentIndex);
			IList<object> optionsList = result.Get<List<object>>("responses");
			string sentence = (string)result ["question"];
			//correctAnswer = result.Get<int> ("correct_answer");
			currentSentence = sentence;
			string[] sentenceTokens = currentSentence.Split ('#');
			senteceView.text = sentenceTokens [0] + " _______________ " + sentenceTokens [1];
			options.showAvailableOptions2 (optionsList);
			currentIndex++;
		} else {
			ParseObject kidTest = new ParseObject("Test");
			kidTest["score"] = score;
			kidTest.SaveAsync();
			finalPanel.SetActive (true);

		}
	}
}

