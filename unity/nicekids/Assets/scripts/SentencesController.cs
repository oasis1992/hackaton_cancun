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
	private string currentSentence;
	private string[] sentences;
	private List<ParseObject> scoreList;

	private int currentIndex;
	private int correctAnswer;
	private int score;
	// Use this for initialization

	void Start ()
	{
		currentIndex = 0;
		score = 0;
		StartCoroutine (getSentencesFromServer ());
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
		loadNextSentence ();

	}
}

